<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Traits\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Models\User;

class FilesController extends Controller
{
    use Helper;
    private $filesPath = 'zip/';


    public function index(){
        $files = DB::table('files')->select('id','filename', 'type', 'size')->paginate(10);
        return view('Files.files' , compact('files'));
    }

    public function create(){
        return view('Files.upload');
    }

    private static function validation(Request $request){

        $validate = $request->validate([
            'file' => 'required|mimes:zip,rar'
        ]);
    }
    public function store(Request $request){

        self::validation($request);

        /**
         * Upload Files to dir
         * @param $file
         * @param $dilename
         * @param $folder
         */
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $folder = uniqid();
        $this->uploadFiles($file ,$filename ,$folder , $this->filesPath .$folder);
        /**
         * @var $size
         * extract zip file
         */
        $this->extr($this->filesPath  .$folder .'/' . $filename , $this->filesPath .$folder);
        $allFiles = File::allFiles(public_path($this->filesPath .$folder));
        /**
         * @var $type
         */
        $type = $request->file->getClientOriginalExtension();
        /**
         * check if user logged in
         * insert to db
         */
        if (Auth::check()){
            foreach($allFiles as $af)
            DB::table('files')->insert([
                'user_id' => Auth::id(),
                'folder' => $folder,
                'filename' => explode("/", $af)[1],
                'type' => File::extension($af),
                'size' => File::size($af),
                'entryuser' => Auth::user()->name,
                'created_at' => Carbon::now()
            ]);
        }
    }

    public function destroy(Request $request){

        try{
            foreach(\request('item') as $item){
                $ff = DB::table('files')->Where('id' , $item)->pluck('filename');
                foreach($ff as $f)
                  if(File::exists(public_path($this->filesPath . $f))){
                    File::delete(public_path($this->filesPath . $f));
                  }
              DB::table('files')->where('id' , $item)->delete();
             }

         }catch(Throwable $e){
             return redirect()->route('files')->with('status', $e);
         }
         return redirect()->route('files')->with('status', 'Files has been deleted.');
    }

    public function filters(Request $request){
        if ($request->ajax()) {

            $attr = explode(" ", $request->attr)[0];
            $val = explode(" ", $request->attr)[1];
            $files = DB::table('files')->orderBy($attr , $val)->select('id','filename', 'type', 'size')->paginate(10);

                if (!empty($files)) {
                    return view('render.files', compact('files'))->render();
                }
            }
            return view('render.files' , compact('files'));
    }

    public function retrieveFiles(){

        return response()->json([User::select('id','name','email')->with(['File' =>function ($q){
            $q;
        }])->get()]);
    }


}

