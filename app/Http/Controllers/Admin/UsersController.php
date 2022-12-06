<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UsersController extends Controller
{
    public function index(){

        $users = DB::table('users')->select('id' , 'name' , 'email' , 'is_admin','deleted_at')->get();
        return view('admin.users' , compact('users'));
    }

    public function create(){
        return view('admin.createuser');
    }

    private static function validation(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
            'password' => ['required','confirmed','min:4'],
        ]);
    }

    public function store(Request $request){
        self::validation($request);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users')->with('status', 'User has been created.');
    }

    public function edit($id){

        $user = DB::table('users')->where('id' ,$id)->select('id' , 'name' , 'email', 'is_admin')->get();
        return view('admin.edituser' , compact('user'));
    }

    public function update(Request $request, $id){

        self::validation($request);

        try{
            DB::table('users')->where('id' ,$id)->update([

                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

        }catch(Throwable $e){

            return redirect()->route('admin.users')->with('status', 'Error happend.');
        }
        return redirect()->route('admin.users')->with('status', 'User has been Updated.');
    }


    public function destroy(Request $request){
        foreach(\request('item') as $id){
            DB::table('users')->where('id' , $id)->delete();

         }
         return redirect()->route('admin.users')->with('status', 'User has been deleted.');
    }

    public function trash(Request $request){
        foreach(\request('item') as $id){
            DB::table('users')->where('id' , $id)->update(['deleted_at' => Carbon::now()]);
         }
         return redirect()->route('admin.users')->with('status', 'User has been moved to trash.');
    }

    public function undo(Request $request){
        foreach(\request('item') as $id){
            DB::table('users')->where('id' , $id)->update(['deleted_at' => null]);
         }
         return redirect()->route('admin.users')->with('status', 'User has been returned back from trash.');
    }
}
