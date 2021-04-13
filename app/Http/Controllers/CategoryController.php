<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=[];
        $categories=Category::get();
        $data['categories']=$categories;
        return view('categories.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //
        $dataInsert=[
            'name'=>$request->name,
        ];
        DB::beginTransaction();
        try{
            Category::create($dataInsert);
            DB::commit();
            return redirect()->route('category.index')->with('Success','Insert category success');
        }catch(\Exception $ex){ 
            DB::rollBack();
            return redirect()->back()->with('Error',$ex->getMessage());
            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data=[];
        
        $category=Category::find($id);
        $data['category']=$category;
        return view('categories.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        //
        $category=Category::find($id);
        $category->name=$request->name;
        DB::beginTransaction();
        try{
            $category->save();
            DB::commit();
            return redirect()->route('category.index')->with('Success','Update category Success');
        }catch(\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('Error',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        DB::beginTransaction();
        try{
            $category=Category::find($id)->delete();
            DB::commit();
            return redirect()->route('category.index')->with('Success','Delete category Success');
        }catch(\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('Error',$ex->getMessage());
        }
    }
}
