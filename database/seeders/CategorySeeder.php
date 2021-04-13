<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data=[
            ['name'=>'Loại sản phẩm 1','created_at'=> Carbon::now(),'updated_at'=>Carbon::now()],
            ['name'=>'Loại sản phẩm 2','created_at'=> Carbon::now(),'updated_at'=>Carbon::now()],
            ['name'=>'Loại sản phẩm 3','created_at'=> Carbon::now(),'updated_at'=>Carbon::now()],
            ['name'=>'Loại sản phẩm 4','created_at'=> Carbon::now(),'updated_at'=>Carbon::now()],
        ];
        DB::table('categories')->insert($data);
    }
}
