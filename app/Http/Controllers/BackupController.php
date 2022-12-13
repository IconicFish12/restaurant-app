<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Artisan;

class BackupController extends Controller
{
    public function index()
    {
        $data = Storage::disk("public_path")->allFiles("backups");
        // $data = File::allFiles("backups");
        $files = collect([]);
        foreach ($data as $file) {
            $files->push(pathinfo($file));
        }
        $files = $files->sortByDesc("filename");

        if(request()->has("download")){
            $file = $files[request("download")]["basename"];
            return Storage::disk("public_path")->download("backups/$file");
        }

        return view('admin.backup', [
            "title" => "Database Backup",
            "page_name" => "Backup Management",
            "data" => $files
        ]);
    }

    public function store()
    {
        if(!\Artisan::call('db:backup')){
            return back()->with('toast_success', 'Successfully Backup Database');
        }
        return back()->with('toast_error', 'Error When Backup Database');
    }

    public function destroy($i)
    {
        $data = Storage::disk("public_path")->allFiles("backups");
        $files = collect([]);
        foreach ($data as $file) {
            $files->push(pathinfo($file));
        }
        $file = $files->sortByDesc("filename")[$i]["basename"];
        if(Storage::disk("public_path")->delete("backups/$file")){
            return back()->with("toast_success", "Successfully Delete this Backup file");
        }
        return back()->with("toast_error", "Error when Delete this Backup file");
    }
}
