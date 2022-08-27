<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class AddDue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add student due current month';

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
     * @return int
     */
    public function handle()
    {
        Mail::raw("This is automatically generated Hourly Update", function($message)
        {


            $message->to("abdullahzahidjoy@gmail.com")->subject('Hourly Update');

        });


        $this->info("ok ");
        return 0;
    }
}
