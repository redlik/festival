<!DOCTYPE html>
<html lang="en" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
    <meta charset="utf-8">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings xmlns:o="urn:schemas-microsoft-com:office:office">
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <style>
        td,th,div,p,a,h1,h2,h3,h4,h5,h6 {font-family: "Segoe UI", sans-serif; mso-line-height-rule: exactly;}
    </style>
    <![endif]-->    <title>Event registration</title>    <style>
        .hover-bg-gray-500:hover {
            background-color: #6b7280 !important;
        }
        @media (max-width: 600px) {
            .sm-w-full {
                width: 100% !important;
            }
            .sm-px-4 {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }
            .sm-py-8 {
                padding-top: 32px !important;
                padding-bottom: 32px !important;
            }
            .sm-px-6 {
                padding-left: 24px !important;
                padding-right: 24px !important;
            }
        }
    </style></head>
<body style="word-break: break-word; -webkit-font-smoothing: antialiased; margin: 0; width: 100%; background-color: #f1f5f9; padding: 0">    <div style="display: none">
    Kerry Mental Health & Wellbeing Fest event registration
    &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847; &#847;
</div>
<div role="article" aria-roledescription="email" aria-label="Event registration" lang="en">    <table style="width: 100%; font-family: ui-sans-serif, system-ui, -apple-system, 'Segoe UI', sans-serif" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center" class="sm-px-4" style="background-color: #f1f5f9">
                <table class="sm-w-full" style="width: 600px" cellpadding="0" cellspacing="0" role="presentation">
                    <tr>
                        <td class="sm-py-8 sm-px-6" style="padding: 48px; text-align: center">
                            <a href="https://kerrymentalhealthandwellbeingfest.com">
                                <img src="{{ asset('img/logo-email@250x.png') }}" width="90" alt="Kerry Festival logo" style="border: 0; max-width: 100%; vertical-align: middle">
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-radius: 4px; background-color: #fff; padding: 24px; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05)">
                            <h2 style="margin: 0; margin-bottom: 24px; font-size: 24px; line-height: 24px; color: #64748b">Event registration</h2>
                            <h4 style="font-weight: 600; line-height: 4px; color: #374151">Hi {{ $attendee->name }},</h4>
                            <p style="margin: 0; margin-bottom: 24px; font-size: 16px; color: #334155">
                                We've found a spot for the event you've shown interest. Hope you can still attend.
                            </p>
                            <div style="margin-bottom: 16px; border-radius: 4px; background-color: #f1f5f9; padding: 8px">
                                <h4 style="margin-top: 8px; margin-bottom: 8px; color: #4b5563">Event details:</h4>
                                <div style="margin-bottom: 8px; display: flex">
                                    <div style="width: 144px; font-weight: 600; color: #64748b">Name:</div>
                                    <div style="color: #4b5563">{{ $attendee->event->name }}</div>
                                </div>
                                <div style="margin-bottom: 8px; display: flex">
                                    <div style="width: 144px; font-weight: 600; color: #64748b">Organiser:</div>
                                    <div style="color: #4b5563">{{ $attendee->event->user->organiser->org }}</div>
                                </div>
                                <div style="margin-bottom: 8px; display: flex">
                                    <div style="width: 144px; font-weight: 600; color: #64748b">Date & time:</div>
                                    <div style="color: #4b5563">{{ \Carbon\Carbon::parse($attendee->event->start_date)->format('d M') }} @ {{ \Carbon\Carbon::parse($attendee->event->start_time)->format('H:i') }}</div>
                                </div>
                                <div style="margin-bottom: 8px; display: flex">
                                    <div style="width: 144px; font-weight: 600; color: #64748b">Location:</div>
                                    <div style="color: #4b5563">{{ $attendee->event->venue->name }}, {{ $attendee->event->venue->town }}</div>
                                </div>
                            </div>
                            <p style="margin-bottom: 16px; color: #475569">We look forward to seeing you at the event! </p>
                            <p style="margin-bottom: 32px; color: #475569">However, if you can't make it please notify the organiser right away. Thank you.</p>
                            <div style="margin-left: auto; margin-right: auto; width: 100%; text-align: center">
                                <a href="{{ route('event.show-by-slug', $attendee->event->slug) }}" class="hover-bg-gray-500" style="text-decoration: none; border-radius: 4px; background-color: #374151; padding-left: 16px; padding-right: 16px; padding-top: 12px; padding-bottom: 12px; color: #fff; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1)">Event details</a>
                            </div>
                            <p style="margin-top: 32px; text-align: center; font-size: 12px; color: #94a3b8">Kerry Mental Health & Wellbeing Fest ©2022</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>  </div>
</body>
</html>
