<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\User;

class TestSendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     public $email;

    public function __construct($value)
    {
        $this->email= $value;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data= $this->email;
            User::create([
                'name' => $data[0],
                'email' => $data[1],
                'password' => $data[2],
            ]);
        
    }
}
