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

class SubCateExcelUpdate implements ShouldQueue
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

        ProductSubCategory::where('pro_id',$getdata['pro_id'])->where('cat_id',$getdata['cat_id'])
                            ->where('id',$getdata['subcatid'])->update($input);

        $d= explode(',', $getdata['d']);
        $matcode = explode(',', $getdata['matcode']);

        $delmatno = DB::table('product_size_mat_no')->where('plant_type',$getdata['plant_code'])
                        ->where('sub_cat_id',$getdata['subcatid'])->delete();

        foreach ($d as $key => $value) {
            
            
            $chkmatcode = DB::table('product_size_mat_no')->where('sub_cat_id',$getdata['subcatid'])
            ->where('product_size',$value)->where('plant_type',$getdata['plant_code'])->first();

            if(!empty($chkmatcode))
            {

    
            $arr['mat_no'] = $matcode[$key];

            DB::table('product_size_mat_no')->where('sub_cat_id',$getdata['subcatid'])
            ->where('product_size',$value)
            ->where('plant_type',$getdata['plant_code'])->update($arr);
            }
            else{

                $arrup['plant_id'] = 1;
                $arrup['plant_type'] = $getdata['plant_code'];
                $arrup['sub_cat_id'] = $getdata['subcatid'];
                $arrup['product_size'] = $value;
                $arrup['mat_no'] = $matcode[$key];

                DB::table('product_size_mat_no')->insert($arrup);
            }

        }

        
    }
}
