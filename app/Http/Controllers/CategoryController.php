<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category', [
            'title' => "Menu Categories",
            "page_name" => "Category Menu",
            "user" => User::orderBy('id', 'ASC')->first(),
            "dataArr" => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request, Category $category  )
    {
        $data = $request->validated();

        if(Category::create($data)){
            return back()->with('success', "$request->category_name created successfully");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json(Category::find($category->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // dd($request);
        $data = $request->validated();

        if($request->category_name == $category->category_name){
            return back()->with('info', "Nothing change");
        }

        if(category::find($category->id)->update($data)){
            return back()->with('success', "Successfully Updated $request->category_name");
        }
        return back()->with('error', "Failed to update $request->category_name");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if(Category::destroy($category->id)){
            return back()->with('success', "Success Delete $category->name");
        }
        return back()->with('error', "Success Delete $category->name");
    }
}
