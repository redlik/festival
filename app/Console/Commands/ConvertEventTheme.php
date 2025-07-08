<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;

class ConvertEventTheme extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:convert-event-theme';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert event theme column to array';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::all();
        foreach ($events as $event) {
          if (!is_array(json_decode($event->theme))) {
            $event->theme = explode(',', $event->theme);
            $event->update();
            $this->info('Event ' . $event->id . ' updated');
          }
        }
    }
}
