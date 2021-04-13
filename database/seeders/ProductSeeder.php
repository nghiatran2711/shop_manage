<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = DB::table('categories')->get();
        if(!empty($categories)){
            foreach($categories as $category){
                $data=[
                    'name'=>Str::random(20),
                    'description'=>Str::random(50),
                    'thumbnail'=>'image.jpg',
                    'category_id'=>$category->id,
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ];
                DB::table('products')->insert($data);
            }
        }
        
    }
}
