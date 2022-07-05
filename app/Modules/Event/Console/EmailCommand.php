<?php

namespace Modules\Event\Console;

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
        // $events = Event::all();

        // if ($events->event_time )



        // foreach ($events as $event) {
        //     Mail::to($event->email)->send(new EventEmail($event));
        // }
    }
}
