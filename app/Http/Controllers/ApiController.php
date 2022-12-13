<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // GET METHOD
    public function getCategory()
    {
        $data = Category::orderBy("id", "ASC")->get();


        if($data->count() == 0){
            return response()->json(["message" => "Data is empty"], 404);
        }

        return response()->json(["message" => "Berhasil", "data" => $data], 200);
    }

    public function getMenuWithCategory(Request $request)
    {
        $data = Menu::where("category_id", $request->category_id)->with("category")->orderBy("id", "ASC")->get();

        if($data->count() == 0 ){
            return response()->json(["message" => "error"], 500);
        }
        return response()->json(["message" => "success", "data" => $data], 200);
    }

    public function getMenu()
    {
        $menu = Menu::orderBy("id", "ASC")->with("category")->get();

        if($menu->count() == 0){
            return response()->json(["message" => "Data is empty"], 404);
        }

        return response()->json(["message" => "success", "data" => $menu], 200);
    }

    public function getTable()
    {
        $table =  Table::orderBy("id", "ASC")->get();

        if($table->count() == 0){
            return response()->json(["message" => "Data is empty"], 404);
        }

        return response()->json( ["message" => "Success", "data" => $table], 200);
    }
}
