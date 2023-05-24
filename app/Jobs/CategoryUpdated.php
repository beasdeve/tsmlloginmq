<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Models\ProductSubCategory;
use App\Models\Models\Category; 
use App\Models\Models\Product; 
use App\Models\User;  
use File; 
use Storage;

class CategoryUpdated implements ShouldQueue
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

        $input['id'] = $getdata['cateId'];
        $input['product_id'] = $getdata['product_id'];
        $input['cat_name'] = $getdata['cat_name']; 
        $input['cat_dese'] = $getdata['cat_dese'];
        $input['slug'] = $getdata['slug'];
        $input['manage_by'] = $getdata['manage_by'];
        $input['primary_image'] = $getdata['primary_image'];
        
        print_r($input);
        $categoryData = Category::where('id',$getdata['cateId'])->update($input);


    }
}
