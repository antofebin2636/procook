<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductResourceCollection;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Language;


class ProductController extends Controller
{
    //

   public function index():ProductResourceCollection
    {
            return new ProductResourceCollection(Product::paginate());
    }

    public function show(Product $id):ProductResource
        {
            return new ProductResource($id);
        }

    public function showByCat($catname):ProductResource
        {

           $product = Product::join('categories', 'categories.id','=','products.category_id')->where('slug', '=', $catname)->get();

            return new ProductResource($product);
        }

     public function store(Request $request)
     {
         $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_category' => 'required',
            'product_price' => 'required',
        ]);

         $product = Product::create($request->all());
        return new ProductResource($product);

     }

     public function update( Request $request, $id):ProductResource
     {
         $request->validate([
             'product_name' => 'required',
             'product_desc' => 'required',
             'product_category' => 'required',
             'product_price' => 'required',
         ]);

         $product = Product::find($id);
         $product->product_name = $request->get('product_name');
         $product->product_desc = $request->get('product_desc');
         $product->product_category = $request->get('product_category');
         $product->product_price = $request->get('product_price');


         $newPro = $product->save();
        return new ProductResource($product);
     }



     public function products(){
       $products = Product::all();
       return view('product',['products' => $products]);
     }

     public function productByCountry($country){

       $countryId = Language::where('slug',$country)->pluck('id');

         $product = Product::with('language')->whereHas('language', function($q) use ($countryId) {
             $q->where('id', '=',$countryId);
         })->get();

        return view('country',['products' => $product]);
     }


}
