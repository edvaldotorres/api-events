<?php

namespace Modules\Event\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Modules\Event\Emails\EventEmail;
use Modules\Event\Entities\Event;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class EmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'event:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email to a event.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $events = Event::all();

        $currentDay = date('Y-m-d H:i');
        
        foreach ($events as $event) {
            
            $eventTime = Carbon::createFromFormat('d/m/Y H:i', $event->event_time)->format('Y-m-d H:i');

            $difference = date_diff(date_create($currentDay), date_create($eventTime));
            $minutes = $difference->days * 24 * 60;
            $minutes += $difference->h * 60;
            $minutes += $difference->i;

            if ($eventTime >= $currentDay && $minutes ==  10) {

                Mail::to($event->email_notification)->send(new EventEmail($event));
                
                $event->sent = true;
                $event->sent_time = $currentDay;  
                $event->save();
            }
        }
    }
}
