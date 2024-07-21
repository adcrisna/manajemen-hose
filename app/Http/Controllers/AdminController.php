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

class AdminController extends Controller
{
    public function index() {
        $title = "Home";
        $user = User::where('role','User')->get();
        $hose = Product::all();
        $machine = Machine::all();
        return view('admin.index', compact('title','user','hose','machine'));
    }
    public function profile()
    {
        $title = 'Profile';
        $admin = User::find(Auth::user()->id);
        return view('admin.profile', compact('title','admin'));
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

                    $namafoto = "Foto Admin"."  ".$request->name." ".date("Y-m-d H-i-s");
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

                    $namafoto = "Foto Admin"."  ".$request->name." ".date("Y-m-d H-i-s");
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
            return Redirect::route('admin.profile');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.profile');
        }
    }
    public function user() {
        $title = 'Data User';
        $user = User::where('role','User')->where('gudang_id',Auth::user()->gudang_id)->get();
        return view('admin.user', compact('title','user'));
    }
    public function addUser(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            $user = new User;
            $namafoto = "Foto User"."  ".$request->name." ".date("Y-m-d H-i-s");
            $extention = $request->file('foto')->extension();
            $photo = sprintf('%s.%0.8s', $namafoto, $extention);
            $destination = base_path() .'/public/foto';
            $request->file('foto')->move($destination,$photo);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;
            $user->gudang_id = Auth::user()->gudang_id;
            $user->password = bcrypt($request->password);
            $user->role = 'User';
            $user->foto = $photo;
            $user->save();

             DB::commit();
            \Session::flash('msg_success','User Berhasil Ditambah!');
            return Redirect::route('admin.user');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.user');
        }
    }
    public function updateUser(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            if (empty($request->foto)) {
                if (empty($request->password)) {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->gudang_id = Auth::user()->gudang_id;
                    $user->save();
                }else {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->gudang_id = Auth::user()->gudang_id;
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
                    $user->gudang_id = Auth::user()->gudang_id;
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
                    $user->gudang_id = Auth::user()->gudang_id;
                    $user->foto = $photo;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }

             DB::commit();
            \Session::flash('msg_success','User Berhasil Diubah!');
            return Redirect::route('admin.user');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.user');
        }
    }
    public function deleteUser($id)
    {
        DB::beginTransaction();
        try {
            $cariUser = User::find($id);
            \File::delete(public_path('foto/'.$cariUser->foto));
            $user = User::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data User Berhasil Dihapus!');
            return Redirect::route('admin.user');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.user');
        }
    }
    public function hose() {
        $title = 'Data Hose';
        $hose = Product::where('gudang_id',Auth::user()->gudang_id)->get();
        $machine = Machine::all();
        $machineID = null;
        return view('admin.hose', compact('title','hose','machine','machineID'));
    }
    public function detailHose($id) {
        $title = 'Data Hose';
        $hose = Product::where('gudang_id',Auth::user()->gudang_id)->where('machine_id',$id)->get();
        $machine = Machine::all();
        $machineID = $id;
        return view('admin.hose', compact('title','hose','machine','machineID'));
    }
    public function addHose(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            $hose = new Product;
            $hose->code = $request->code;
            $hose->name = $request->name;
            $hose->spesifikasi = $request->spesifikasi;
            $hose->date = $request->date;
            $hose->stock = $request->stock;
            $hose->machine_id = $request->machine_id;
            $hose->gudang_id = Auth::user()->gudang_id;
            $hose->user_id = Auth::user()->id;
            $hose->save();

            $history = new History;
            $history->product_id = $hose->id;
            $history->jumlah = $hose->stock;
            $history->status = 'New Hose';
            $history->user_id = Auth::user()->id;
            $history->save();

             DB::commit();
            \Session::flash('msg_success','Hose Berhasil Ditambah!');
            return Redirect::route('admin.hose');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.hose');
        }
    }
    public function updateHose(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            $hose = Product::find($request->id);
            $hose->code = $request->code;
            $hose->name = $request->name;
            $hose->spesifikasi = $request->spesifikasi;
            $hose->date = $request->date;
            $hose->machine_id = $request->machine_id;
            $hose->gudang_id = Auth::user()->gudang_id;
            $hose->user_id = Auth::user()->id;
            $hose->save();

            $history = new History;
            $history->product_id = $request->id;
            $history->jumlah = null;
            $history->status = 'Update Hose';
            $history->user_id = Auth::user()->id;
            $history->save();

             DB::commit();
            \Session::flash('msg_success','Hose Berhasil Diubah!');
            return Redirect::route('admin.hose');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.hose');
        }
    }
    public function deleteHose($id)
    {
        DB::beginTransaction();
        try {
            $hose = Product::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Hose Berhasil Dihapus!');
            return Redirect::route('admin.hose');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.hose');
        }
    }
    public function updateStock(Request $request) {
        DB::beginTransaction();
        try {
            if ($request->status == 'Masuk') {
                $hose = Product::find($request->id);
                $newStock = $hose->stock + $request->jumlah;
                $hose->stock = $newStock;
                $hose->user_id = Auth::user()->id;
                $hose->save();

                $history = new History;
                $history->product_id = $request->id;
                $history->jumlah = $request->jumlah;
                $history->status = 'Masuk';
                $history->user_id = Auth::user()->id;
                $history->save();
            }else {
                $hose = Product::find($request->id);
                if ($request->jumlah > $hose->stock) {
                    \Session::flash('msg_error','Jumlah Keluar Tidak Boleh lebih dari Stock!');
                    return Redirect::route('admin.hose');
                }
                $newStock = $hose->stock - $request->jumlah;
                $hose->stock = $newStock;
                $hose->user_id = Auth::user()->id;
                $hose->save();

                $history = new History;
                $history->product_id = $request->id;
                $history->jumlah = $request->jumlah;
                $history->status = 'Keluar';
                $history->user_id = Auth::user()->id;
                $history->save();
            }
             DB::commit();
            \Session::flash('msg_success','Stock Hose Berhasil Diubah!');
            return Redirect::route('admin.hose');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.hose');
        }
    }
    public function machine() {
        $title = 'Data Machine';
        $machine = Machine::all();
        return view('admin.machine', compact('title','machine'));
    }
    public function addMachine(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            $machine = new Machine;
            $machine->name = $request->name;
            $machine->save();

             DB::commit();
            \Session::flash('msg_success','Machine Berhasil Ditambah!');
            return Redirect::route('admin.machine');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.machine');
        }
    }
    public function updateMachine(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            $machine = Machine::find($request->id);
            $machine->name = $request->name;
            $machine->save();

             DB::commit();
            \Session::flash('msg_success','Machine Berhasil Diubah!');
            return Redirect::route('admin.machine');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.machine');
        }
    }
    public function deleteMachine($id)
    {
        DB::beginTransaction();
        try {
            $machine = Machine::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Machine Berhasil Dihapus!');
            return Redirect::route('admin.machine');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.machine');
        }
    }
}
