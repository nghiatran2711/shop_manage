<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        // $categories=Category::pluck('name','id');
        $data=[];
        

        $products=Product::with('category');
        // add new param to search
        // search post name
        if (!empty($request->product_name)) {
            $products = $products->where('name', 'like', '%' . $request->product_name . '%');
        }

        // search category_id
        // if (!empty($request->category_id)) {
        //     $products = $products->where('category_id', $request->category_id);
        // }

        // order ID desc
        $products = $products->orderBy('id', 'desc');
        
        // // pagination
        $products = $products->paginate(2);
        $data['products']=$products;
        // $data['categories']=$categories;
        return view('products.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data=[];
        $categories=Category::pluck('name','id');
        $data['categories']=$categories;
        return view('products.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
        $thumbnailPath=null;

        if($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()){
            $image = $request->file('thumbnail');
            $extension = $request->thumbnail->extension();
            $fileName = 'thumbnail_' . time() . '.' . $extension;
            $thumbnailPath = $image->move('thumbnail', $fileName);
        }

        $dataInsert=[
            'name'=>$request->name,
            'description'=>$request->description,
            'thumbnail'=>$thumbnailPath,
            'category_id'=>$request->category_id,
        ];
        DB::beginTransaction();

        try {
            // insert into table Products
            Product::create($dataInsert);
            DB::commit();
            // success
            return redirect()->route('product.index')->with('success', 'Insert product successful!');
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->with('error', $ex->getMessage());
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
        $categories=Category::pluck('name','id');
        $product=Product::find($id);
        $data['categories']=$categories;
        $data['product']=$product;
        return view('products.edit',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product=Product::find($id);
        $oldThumbnail=$product->thumbnail;
        $product->name=$request->name;
        $product->description=$request->description;
        $product->category_id=$request->category_id;
        // dd($request->all());
        $thumbnailPath=null;
        if($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()){
            $image = $request->file('thumbnail');
            $extension = $request->thumbnail->extension();
            $fileName = 'thumbnail_' . time() . '.' . $extension;
            $thumbnailPath = $image->move('thumbnail', $fileName);
            $product->thumbnail=$thumbnailPath;
            Log::info('thumbnailPath: ' . $thumbnailPath);
        }
        DB::beginTransaction();
        try{
            $product->save();
            DB::commit();
            // SAVE OK then delete OLD file
            if (File::exists(public_path($oldThumbnail)) && $request->hasFile('thumbnail') ) {
                File::delete(public_path($oldThumbnail));
            }
            // success
            return redirect()->route('product.index')->with('success', 'Insert product successful!');
        } catch (\Exception $ex) {
            DB::rollback();

            return redirect()->back()->with('error', $ex->getMessage());
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
        
        try{
            $product=Product::findOrFail($id);
            $thumbnail=$product->thumbnail;
            $product->delete();
            if(FILE::exists(public_path($thumbnail))){
                File::delete(public_path($thumbnail));
            }
            return redirect()->route('product.index')->with('success', 'Delete successful!');
        }catch(\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }
}
