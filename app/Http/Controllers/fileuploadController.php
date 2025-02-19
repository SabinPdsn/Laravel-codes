<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class fileuploadController extends Controller
{
    public function StoreFileAndGivePath(Request $request){
        //let we are storing any documents which are in multiple numbers,lets say "My_Documents" is a key passed
        $request->validate([
            'My_Documents' => 'required|file|mimes:png,jpg,jpeg,svg,pdf|max:5120',
        ]);

        if($request->hasFile('My_Documents')){
            $retrive_file = $request->file('My_Documents');
        foreach ($retrive_file as $key => $document){

            $filepath = $this->storeandgivepath($document,'Mero_Documents',$key);
            $file_paths[] = $filepath;//for multiple files uploads
        }

        return response()->json([
            "message"=>"file uploaded successfully",
            "filepath"=>$file_paths
        ]);
        }
        return response()->json("an error occured while uploading file");
    }

    protected function storeandgivepath($file, $folder, $key){
        $filename = time() . "_{$key}" . $file->getClientOriginalExtension();
        return $file->storeAs($folder,$filename,'public');
        //we can give any name in place of 'public' but we have to specify it in filesystem.php
    }
}
