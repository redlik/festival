# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project overview

A Laravel 10 application for running a festival: organisers submit events (with venues, dates, capacity), attendees book/register for them, and admins review and approve everything through both a custom admin area and a Filament admin panel. Frontend uses Blade + Livewire + Alpine.js + Tailwind, built with Laravel Mix.

## Commands

PHP dependencies are managed with Composer, JS with npm; assets build via Laravel Mix (webpack).

```bash
# Install deps
composer install
npm install

# Run the app
php artisan serve

# Build frontend assets
npm run dev        # one-off dev build
npm run watch       # rebuild on change
npm run prod        # production build

# Queue worker (jobs are queued — see Architecture)
php artisan queue:work
# or, since laravel/horizon is installed:
php artisan horizon

# Tests (PHPUnit, sqlite in-memory + sync queue + array mail, see phpunit.xml)
php artisan test
vendor/bin/phpunit
vendor/bin/phpunit --filter=TestClassName::test_method_name
vendor/bin/phpunit tests/Feature/EventReminderTest.php

# Lint / style (StyleCI config in .styleci.yml runs remotely; Pint is available locally)
vendor/bin/pint

# Filament panel resource generation (admin panel lives at /administrator)
php artisan filament:upgrade
```

## Architecture

### Domain model

- **Organiser** `belongsTo User`, and `hasManyThrough Event` (via User). A `User` becomes an organiser by having an `Organiser` record (`User::organiser()` is `hasOne`).
- **Event** `belongsTo Venue`, `belongsTo User` (the organiser's user account, giving `Event::organiser()` via `hasOneThrough`), `belongsToMany Document`, `hasMany Attendee`, `hasMany Booking`. Soft-deletes. Uses Spatie MediaLibrary for a single `cover` image (disk `covers`, `thumb` conversion 368x232). `scopeApproved()` filters `status = 'published'` ordered by start date/time — this is the query used everywhere the public-facing event list is built.
  - **Visibility** is one of three mutually-exclusive states, submitted from event forms as a single `visibility` radio (`public`/`private`/`external`) and resolved server-side (`EventController::visibilityFields()`) into two DB columns: `is_private` (listed, but no booking) and `is_external_booking` + `external_booking_url` (booking happens on a third-party site — the Livewire `BookingPanel` renders a "Book now" link instead of the registration form). Public is simply both flags false. Any code branching on event bookability should check `is_external_booking` before `is_private`.
- **Attendee**: a booking-line for a single event (`belongsTo Event`, `belongsTo User`), with a `waiting_status` flag distinguishing confirmed (`Event::booked()`) from waitlisted (`Event::waiting()`) registrations. `AttendeeObserver` (app/Observers) hooks into its lifecycle.
- **Booking**: groups attendees registered together (`hasMany` from Event's perspective via `belongsTo` on Booking); generates its own unique ID (`newUniqueId()`).
- **Venue** `hasMany Event`.
- **Document**: organiser-uploaded compliance docs (e.g. Garda vetting/insurance), `belongsToMany Event`.
- **Setting**: key/value admin-configurable settings, managed through the Filament `SettingResource`.

Festival-wide dates (not per-event) come from `config/festival.php` (`festival_start_date`/`festival_end_date`), cached and exposed via `App\Services\FestivalService`.

### Roles and access control

Uses `spatie/laravel-permission` (`HasRoles` on `User`). Two roles gate routes in `routes/web.php`: `admin` and `organiser`. Route groups:
- `middleware('role:admin')` under `/admin/*` — approval, publishing/unpublishing events, exporting attendees/organisers, managing venues.
- `middleware('role:organiser')` plus a custom `disabled` middleware (`App\Http\Middleware\DisabledOrganiser`) under `/dashboard/*` — an organiser's own event/document/attendee management. The `disabled` middleware blocks organisers whose account has been disabled by an admin.
- A separate Filament panel (`App\Providers\Filament\AdministratorPanelProvider`) is mounted at `/administrator` for a lower-level admin UI (currently only `User` and `Setting` resources) — distinct from the custom `/admin` dashboard built with Blade/Livewire.

### Event lifecycle

Events move through statuses (`draft`, submitted, `published`, cancelled, etc. — see `EventController` and admin routes: `event.save-draft`, `event.update-and-submit`, `admin.event.approve`, `admin.event.unpublish`, `event.cancel`). Admins can request additional documents from an organiser before approving (`admin.event.request-docs`). Only `published` events (via `scopeApproved`) are shown to the public.

### Notifications & background jobs

Queued jobs in `app/Jobs` handle transactional email: `BookingEmailToAttendee`, `BookingEmailToOrganiser`, `EventCancelledNotification`, `MessageEmailToAttendees`, `AttendeeRegistration`, `EventReminderJob`. `EventReminderJob` is dispatched by the `SendEventReminder` console command (see `app/Console/Commands`), intended to run on a schedule. Laravel Horizon manages the Redis queue in non-test environments; tests force `QUEUE_CONNECTION=sync`.

### Livewire components

`app/Livewire` holds the interactive pieces composed into Blade pages: event/attendee/organiser listing and admin tables (`EventList`, `AttendeeList`, `OrganiserListAdmin`, `AdminEvents`, `AdminAttendees`), the booking flow (`BookingPanel`, `BookingDateForm`, `BookingList`, `BookingCancellationPanel`), and misc UI (`HomepageBanner`, `VenueEntry`).

### Testing

`tests/Feature` covers auth flows (from Laravel Breeze scaffolding) plus `EventReminderTest`. `phpunit.xml` runs against an in-memory sqlite DB with synchronous queue and array mailer/session drivers — no external services needed to run the suite.
