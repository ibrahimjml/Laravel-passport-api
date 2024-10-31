<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{



    public function index()
    {
        return  new ProductCollection(Product::all());
    }

    
    public function create(ProductRequest $request)
    {
        $product = new Product;
        
        $product->user_id = Auth::id();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->size = $request->size; 
      
        $slug=Str::slug($request->title);
        $count=Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $product->slug = $slug;
        $product->save();
        return response()->json([
          'data'=> new ProductResource($product)
        ],200);
    }

  


    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(Request $request,Product $product)
    {
      if(Auth::user()->id !== $product->user_id){
        return response()->json(['message'=>'unauthorized action'],403);
      }else{
        
        $product->update($request->all());
        return response()->json([
          'data'=> new ProductResource($product)
        ],200);
      }
    }

    public function destroy(Product $product)
    {
      if(Auth::user()->id !== $product->user_id){
        return response()->json(['message'=>'unauthorized action'],403);
      }else{
        $product->delete();
        return response()->json([
          'message'=> 'product deleted successfuly'
        ],200);
      }
      
    }


}
