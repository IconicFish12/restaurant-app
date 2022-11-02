<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use App\Models\Category;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.menu', [
            'title' => "Vanushki Menus",
            'page_name' => "Vanushki Menu",
            "user" => User::where('role', 'admin')->first(),
            "dataArr" => Menu::latest()->filter(request(['search']))->with('category')->paginate(request('paginate') ?? 10),
            "category" => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRequest $request)
    {
        // dd($request);
        $data = $request->validated();

        // $fileName = $request->file('image')->getClientOriginalName();

        $data['image'] = $request->file('image')->store('/images', "public_path");

        if(Menu::create($data)){
            return back()->with('success', "Successfully created $request->name");
        }
        return back()->with('error', "Faild when created $request->name");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return response()->json(Menu::find($menu->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $data = $request->validated();

        if($request->hasFile('image')){
            if(Storage::disk("public_path")->exists($menu->image)){
                Storage::disk("public_path")->delete($menu->image);

            }
            $data['image'] = $request->file('image')->store('images', "public_path");
        }

        if($menu->update($data)){
            return back()->with('success', "Successfully Updating Menu $request->name");
        }
        return back()->with('error', "Error When Updating Menu $request->name");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if(Menu::destroy($menu->id)){
            Storage::disk('public_path')->delete($menu->image);

            return back()->with('success', "Successfully Delete $menu->name");
        }
        return back()->with('error', "Failed to Delete $menu->name");
    }
}
