<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Models\Category;
use App\Models\Models\ProductSubCategory;

class CategoryCreated implements ShouldQueue
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
        Category::create([
            'id' => $this->data['id'],
            'product_id' => $this->data['product_id'],
            'cat_name' =>$this->data['cat_name'],
            'cat_dese' =>$this->data['cat_dese'],
            'slug' =>$this->data['slug'],
            'primary_image' => (!empty($this->data['primary_image'])) ? $this->data['primary_image'] : '',
            'image_2' => (!empty($this->data['image_2'])) ? $this->data['image_2'] : '',
            'image_3' => (!empty($this->data['image_3'])) ? $this->data['image_3'] : '',
            'image_4' => (!empty($this->data['image_4'])) ? $this->data['image_4'] : '',
        
        ]);
    }
}
