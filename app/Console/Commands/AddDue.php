<?php

namespace App\Console\Commands;

use App\Models\User;
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
        $currentMonth = now()->format("Y-m");
        $students = User::with(['class:id,monthly_fee'])->get();

        foreach ($students as $student ){
            $due = $student->credit()->where('date',$currentMonth)->first();
            if(empty($due)){
                $data['amount'] = $student->class->monthly_fee;
                $data['type'] = "monthly fee";
                $data['date'] = $currentMonth;
                $student->credit()->create($data);
            }

        }

        Mail::raw("This is automatically Due command run response Update", function($message)
        {
            $message->to("abdullahzahidjoy@gmail.com")->subject('Due command run response');

        });


        $this->info("ok ");
        return 0;
    }
}
