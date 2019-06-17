<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CategoriesController extends Controller
{
    public function index()
    {
        // достаем все категории из БД
        $categories = Category::all();
        // отображаем категории в админке
        return view('admin.categories.index',[
            'categories' => $categories
        ]);
    }
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required' // валидация на обзательное сохранение
        ]);
        Category::create($request->all());
        return redirect()->route('categories.index');
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit',['category'=>$category]);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'title' => 'required' // валидация на обзательное сохранение
        ]);
        $category = Category::find($id);
        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();

        return redirect()->route('categories.index');
    }

}
