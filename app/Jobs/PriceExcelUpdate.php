<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Models\Product;
use App\Models\Models\Category;
use App\Models\Models\ProductSubCategory;
use App\Models\Models\PriceManagement;
use App\Models\Models\PriceCalculation;
use App\Models\Models\ThresholdLimits;
use App\Models\Models\Freights;

class PriceExcelUpdate implements ShouldQueue
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

         
        $input['BPT_Price'] = $getdata['BPT_Price'];
        $input['Price_Premium_sing'] = $getdata['Price_Premium_sing'];
        $input['Price_Premium'] = $getdata['Price_Premium'];
        $input['Misc_Expense'] = $getdata['Misc_Expense']; 
        $input['CAM_Discount'] = $getdata['CAM_Discount'];
        $input['Interest_Rate'] = $getdata['Interest_Rate'];
        

        PriceCalculation::where('pro_id',$getdata['pro_id'])
                        ->where('cat_id',$getdata['cat_id'])
                        ->where('sub_cat_id',$getdata['sub_cat_id'])
                        ->where('size',$getdata['size'])
                        ->where('type',$getdata['type'])
                        ->update($input);

        print_r($getdata);
    }
}
