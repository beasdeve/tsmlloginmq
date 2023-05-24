<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Address;

class UserAddress implements ShouldQueue
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
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        print_r($this->data);

        foreach ($this->data['ship'] as $key => $value) {
          // code...
            Address::create([
               'user_id' => $this->data['id'],
               'company_name' => $value['company_name'],
               'addressone' => $value['addressone'],
               'addresstwo' => $value['addresstwo'],
               'city' =>$value['city'],
               'state' =>$value['state'],
               'pincode' =>$value['pincode'],
               'gstin' =>$value['gstin'],
               'type' => 'A',
            ]);

            if($value['company_name'] == 'Y')
            {
              Address::create([
                 'user_id' => $this->data['id'],
                 'company_name' => $value['company_name'],
                 'addressone' => $value['addressone'],
                 'addresstwo' => $value['addresstwo'],
                 'city' =>$value['city'],
                 'state' =>$value['state'],
                 'pincode' =>$value['pincode'],
                 'gstin' =>$value['gstin'],
                 'type' => 'B',
              ]);
            }
        }

        //  billing ------------
        foreach ($this->data['bill'] as $k => $v) {
          // code...
            Address::create([
               'user_id' => $this->data['id'],
               'company_name' => $v['company_name'],
               'addressone' => $v['addressone'],
               'addresstwo' => $v['addresstwo'],
               'city' =>$v['city'],
               'state' =>$v['state'],
               'pincode' =>$v['pincode'],
               'gstin' =>$v['gstin'],
               'type' => 'B',
            ]);
        }
    }
}
