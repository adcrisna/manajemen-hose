<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Auth;
use DB;
use App\Models\User;
use App\Models\Gudang;
use App\Models\Machine;
use App\Models\Product;
use App\Models\History;

class UserController extends Controller
{
    public function index() {
        $title = "Home";
        $hose = Product::where('gudang_id', Auth::user()->gudang_id)->get();
        $machine = Machine::all();
        return view('user.index', compact('title','hose','machine'));
    }
    public function profile()
    {
        $title = 'Profile';
        $user = User::find(Auth::user()->id);
        return view('user.profile', compact('title','user'));
    }
    public function updateProfile(Request $request){
        DB::beginTransaction();
        try {
            if (empty($request->foto)) {
                if (empty($request->password)) {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->save();
                }else {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }else {
                if (empty($request->password)) {
                    $user = User::find($request->id);

                    \File::delete(public_path('foto/'.$user->foto));

                    $namafoto = "Foto User"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('foto')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('foto')->move($destination,$photo);

                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->foto = $photo;
                    $user->save();
                }else {
                    $user = User::find($request->id);

                    \File::delete(public_path('foto/'.$user->foto));

                    $namafoto = "Foto User"."  ".$request->name." ".date("Y-m-d H-i-s");
                    $extention = $request->file('foto')->extension();
                    $photo = sprintf('%s.%0.8s', $namafoto, $extention);
                    $destination = base_path() .'/public/foto';
                    $request->file('foto')->move($destination,$photo);

                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->foto = $photo;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }
             DB::commit();
            \Session::flash('msg_success','Profile Berhasil Diubah!');
            return Redirect::route('user.profile');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('user.profile');
        }
    }
    public function hose() {
        $title = 'Data Hose';
        $hose = Product::where('gudang_id',Auth::user()->gudang_id)->get();
        $machine = Machine::all();
        $machineID = null;
        return view('user.hose', compact('title','hose','machineID'));
    }
    public function detailHose($id) {
        $title = 'Data Hose';
        $hose = Product::where('gudang_id',Auth::user()->gudang_id)->where('machine_id',$id)->get();
        $machine = Machine::all();
        $machineID = $id;
        return view('user.hose', compact('title','hose','machineID'));
    }
    public function machine() {
        $title = 'Data Machine';
        $machine = Machine::all();
        return view('user.machine', compact('title','machine'));
    }
}
