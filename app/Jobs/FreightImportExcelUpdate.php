<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Models\Freights;
use App\Models\User;
use DB;

class FreightImportExcelUpdate implements ShouldQueue
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
        $getdata = $this->data; 
        
 
    	$input['freight_charges'] = $getdata['freight_charges']; 
        $input['manage_by'] = $getdata['manage_by']; 

        Freights::where('pickup_from',$getdata['pickup_from'])
                        ->where('location',$getdata['location'])
                        ->where('destation_location',$getdata['destation_location'])
                        ->update($input);

        print_r($getdata);
    }
}
