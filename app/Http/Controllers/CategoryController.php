<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $per_page = 10;
    
    public function list()
    {
        //
        $categories = Category::whereNull('category_id')
            ->with('childrenCategories')
            ->paginate($this->per_page);
        return view('categories.index', ['categories' => $categories]);
    }

    public function create(){

        return view('categories.create');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request){
        
        $category = Category::create([
            'slug' => $request->slug,
            'name' => $request->name,
            'default' => 0
        ]);

        if($category){
            return redirect()->route('index.category')->with(['success' => 'created']);
        }else{
            return redirect()->route('index.category')->with(['error' => 'error']);
        }
    }


    public function edit($id)
    {
        //

        $category = Category::find($id);
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate($request, [
            'slug' => 'required|alpha_dash|max:80|unique:categories,slug,' . $request->id,
            'name' => 'required|string|max:60',
            'description' => 'string|nullable',
        ]);

        $category = Category::find($request->id);
        $category->slug = $request->slug;
        $category->name = $request->name;
        
        if($category->update()){
            return redirect()->route('edit.category', ['id' => $category->id])->with(['success' => 'edited']);
        } else {
            return redirect()->route('index.category')->with(['error' => 'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {

        $category = Category::find($request->record_id);
        if ($category->default == 1) {
            return redirect()->route('index.category')->with(['error' => 'category_default']);
        } else {
        if ($category->delete()) {
            return redirect()->route('index.category')->with(['success' => 'deleted']);
        } else {
            return redirect()->route('index.category')->with(['error' => 'error']);
        }
    }
    }
}
