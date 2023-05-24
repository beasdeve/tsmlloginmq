<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Models\Category;
use App\Models\Models\Product;
use App\Models\Models\ProductSubCategory;
use File; 
use Storage;
use DB; 


class SubcategoryCreated implements ShouldQueue
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
        $getdata = $this->data;
        
        $input['id'] = $getdata['subcatid'];
        $input['cat_id'] = $getdata['cat_id'];
        $input['pro_id'] = $getdata['pro_id'];
        $input['sub_cat_name'] = $getdata['sub_cat_name'];
        $input['slug'] = $getdata['sub_cat_name'];
        $input['sub_cat_dese'] = $getdata['sub_cat_dese'];
        $input['pro_size'] = $getdata['pro_size'];
        $input['Cr'] = $getdata['Cr'];
        $input['C'] = $getdata['C'];
        $input['Phos'] = $getdata['Phos'];
        $input['S'] = $getdata['S'];
        $input['Si'] = $getdata['Si'];
        $input['Ti'] = $getdata['Ti'];
        $input['plant_code'] = $getdata['plant_code'];

        
        $mt = implode(",",$getdata['rmatno']);
        $mt3 = explode(',',$mt);
        $psize1 = implode(",",$getdata['rprosize']);
        $psize2 = explode(',',$psize1);
        foreach ($mt3 as $key => $value) 
        {
          $dv['plant_id'] = 1;
          $dv['plant_type'] = $getdata['plant_code'];
          $dv['sub_cat_id'] = $getdata['subcatid'];
          $dv['product_size'] = $psize2[$key];
          $dv['mat_no'] = $value;
          $ins = DB::table('product_size_mat_no')->insert($dv);
        }
        // dd($input);
         ProductSubCategory::create($input); 

    }
}
