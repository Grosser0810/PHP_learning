<?php

namespace App\Http\Controllers\API;

use App\Group;
use App\Manufacturer;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::latest()->paginate(6);
    }

    public function soloProduct()
    {
        $id = \Request::get('id');
        $product = Product::where(function($query) use ($id){
            $query->where('id','LIKE',"%$id%");
        });
        //dd($id);
        //dd($product->get()->toArray());
        return $product->get();

        //dd($product->get()->toArray());
    }

    public function group()
    {
        return Group::all();
    }

    public function manufacturer()
    {
            return Manufacturer::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'title' => 'required|string',
            'code'=> 'required|string|',

        ]);

        $name = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        \Image::make($request->image)->save(public_path('img/product/') . $name);


        return Product::create([
            'title' => $request['title'],
            'image' => $name,
            'stock' => $request['stock'],
            'code' => $request['code'],
            'description' => $request['description'],
            'price' => $request['price'],
            'composition' => $request['composition'],
            'group_id' => $request['group_id'],
            'manufacturer_id' => $request['manufacturer_id'],

        ]);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $product = Product::findOrFail($id);

        $this->validate($request,[
            'title' => 'required|string',
            'image'=> 'required',
            'stock'=> 'required',
            'code'=> 'required',
            'description'=> 'required',
            'price'=> 'required',
            'composition'=> 'required',
            'group_id'=> 'required',
            'manufacturer_id'=> 'required',

        ]);

        $currentImage = $product->image;

            $name = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('img/product/') . $name);
            $request->merge(['image' => $name]);
            $productImage = public_path('img/product/') . $currentImage;
            if (file_exists($productImage)) {
                @unlink($productImage);
            }



        $product->update($request->all());
        return ['message' => 'Update'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();
        $currentImage = $product->image;
        $productImage = public_path('img/product/') . $currentImage;
        if (file_exists($productImage)) {
            @unlink($productImage);
        }

        return ['message'=>'Product has deleted', 'data_product'=>$product];
    }

    public function search(){
        if ($search = \Request::get('q')) {
            $products = Product::where(function($query) use ($search){
                $query->where('title','LIKE',"%$search%")
                    ->orWhere('stock','LIKE',"%$search%")
                    ->orWhere('code','LIKE',"%$search%");
            })->paginate(6);
        }else{
            $products = Product::latest()->paginate(6);
        }
        return $products;
    }

    public function filter(Request $request, Product $product){

       $product = $product->newQuery();


      if ($request->has('g')){

            $product->whereHas('group', function ($query) use ($request) {
                $groups = \Request::get('g');
                if ($groups != ''){
                $query->where('group_id', $request->input('g'));
                }
            });
        }

      if ($request->has('m')){
          $product->whereHas('manufacturer', function ($query) use ($request){
              $manufacturers = \Request::get('m');
              $arrayRequest = explode(',',$manufacturers);
              if ($arrayRequest[0] != ''){
              $query->whereIn('manufacturer_id',$arrayRequest);
              }
          });

        }
            return $product->latest()->paginate(6);

    }

}
