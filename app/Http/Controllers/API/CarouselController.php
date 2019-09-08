<?php

namespace App\Http\Controllers\API;

use App\Carousel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarouselController extends Controller
{
    public function index()
    {
        return Carousel::latest()->paginate(10);
    }



    public function store(Request $request)
    {

        $name = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        \Image::make($request->image)->save(public_path('img/carousel/') . $name);

        return Carousel::create([
            'image' => $name,

        ]);

    }

    public function update(Request $request, $id)
    {


        $slide = Carousel::findOrFail($id);

        $this->validate($request,[
            'image'=> 'required',
        ]);

        $currentImage = $slide->image;

        $name = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
        \Image::make($request->image)->save(public_path('img/carousel/') . $name);
        $request->merge(['image' => $name]);
        $slideImage = public_path('img/carousel/') . $currentImage;
        if (file_exists($slideImage)) {
            @unlink($slideImage);
        }

        $slide->update($request->all());
        return ['message' => 'Update'];
    }

    public function destroy($id)
    {
        $slide = Carousel::findOrFail($id);

        $slide->delete();
        $currentImage = $slide->image;
        $slideImage = public_path('img/carousel/') . $currentImage;
        if (file_exists($slideImage)) {
            @unlink($slideImage);
        }

        return ['message'=>'Product has deleted', 'data_product'=>$slide];
    }

}
