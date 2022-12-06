<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\Helper;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FileController extends Controller
{

    use Helper;
    private $filesPath = 'zip/';


    public function index(){
        $users = DB::table('users')->select('id' , 'name')->get();
        return view('admin.files', compact('users'));
    }

    private static function validation(Request $request){

        $validate = $request->validate([
            'file' => 'required|mimes:zip,rar'
        ]);
    }

    public function getId(Request $request){
        if($request->ajax())
            session()->put('uid' , $request->id);
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
                'user_id' => session()->get('uid'),
                'folder' => $folder,
                'filename' => explode("/", $af)[1],
                'type' => File::extension($af),
                'size' => File::size($af),
                'entryuser' => Auth::user()->name,
                'created_at' => Carbon::now()
            ]);
        }

    }
}
