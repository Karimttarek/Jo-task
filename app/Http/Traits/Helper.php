<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use ZipArchive;

Trait Helper
{
    public function uploadFiles($file , $filename , $folder , $path){

        $f = $file;
        $fn = $filename;
        $dir = $folder;
        $file->move($path, $filename);
    }

    public function extr($oFile , $extToPath){

        $zip = new ZipArchive;
        $z = $zip->open($oFile);
        $zip->extractTo($extToPath);
        $zip->close();

    }
}
