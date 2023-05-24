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

class ProductCreate implements ShouldQueue
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
        // print_r($this->data);
        $getdata = $this->data;

        

        $input['id'] = $getdata['proId'];
        $input['pro_name'] = $getdata['pro_name'];
        $input['pro_desc'] = $getdata['pro_desc']; 
        $input['slug'] = $getdata['slug'];
        $input['manage_by'] = $getdata['manage_by'];
        
        $productData = Product::create($input);
        print_r($input);

        
    }
}
