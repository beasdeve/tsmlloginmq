<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserManagement implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         print_r($this->data);
    
         User::create([
            'id' => $this->data['id'],
            'login_attempt' => $this->data['login_attempt'],
            'password' => $this->data['password'],
            'user_type' => $this->data['user_type'],
            'phone' => $this->data['phone'],
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'zone' => $this->data['zone'],
            'user_status' => $this->data['user_status'],
         ]);
    }
}
