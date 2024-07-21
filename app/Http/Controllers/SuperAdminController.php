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

class SuperAdminController extends Controller
{
    public function index() {
        $title = "Home";
        $gudang = Gudang::all();
        $admin = User::where('role','Admin')->get();
        $hose = Product::all();
        $machine = Machine::all();
        return view('superadmin.index', compact('title','gudang','admin','hose','machine'));
    }
    public function profile()
    {
        $title = 'Profile';
        $superadmin = User::find(Auth::user()->id);
        return view('superadmin.profile', compact('title','superadmin'));
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

                    $namafoto = "Foto Super Admin"."  ".$request->name." ".date("Y-m-d H-i-s");
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

                    $namafoto = "Foto Super Admin"."  ".$request->name." ".date("Y-m-d H-i-s");
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
            return Redirect::route('superadmin.profile');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('superadmin.profile');
        }
    }
    public function gudang() {
        $title = 'Data Gudang';
        $gudang = Gudang::all();
        return view('superadmin.gudang', compact('title','gudang'));
    }
    public function addGudang(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            $gudang = new Gudang;
            $gudang->name = $request->name;
            $gudang->save();

             DB::commit();
            \Session::flash('msg_success','Gudang Berhasil Ditambah!');
            return Redirect::route('superadmin.gudang');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('superadmin.gudang');
        }
    }
    public function updateGudang(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            $gudang = Gudang::find($request->id);
            $gudang->name = $request->name;
            $gudang->save();

             DB::commit();
            \Session::flash('msg_success','Gudang Berhasil Diubah!');
            return Redirect::route('superadmin.gudang');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('superadmin.gudang');
        }
    }
    public function deleteGudang($id)
    {
        DB::beginTransaction();
        try {
            $gudang = Gudang::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Gudang Berhasil Dihapus!');
            return Redirect::route('superadmin.gudang');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('superadmin.gudang');
        }
    }
    public function admin() {
        $title = 'Data Admin';
        $admin = User::where('role','Admin')->get();
        $gudang = Gudang::all();
        return view('superadmin.admin', compact('title','admin','gudang'));
    }
    public function addAdmin(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            $admin = new User;
            $namafoto = "Foto Admin"."  ".$request->name." ".date("Y-m-d H-i-s");
            $extention = $request->file('foto')->extension();
            $photo = sprintf('%s.%0.8s', $namafoto, $extention);
            $destination = base_path() .'/public/foto';
            $request->file('foto')->move($destination,$photo);

            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->no_hp = $request->no_hp;
            $admin->gudang_id = $request->gudang_id;
            $admin->password = bcrypt($request->password);
            $admin->role = 'Admin';
            $admin->foto = $photo;
            $admin->save();

             DB::commit();
            \Session::flash('msg_success','Admin Berhasil Ditambah!');
            return Redirect::route('superadmin.admin');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('superadmin.admin');
        }
    }
    public function updateAdmin(Request $request)
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
                    $user->gudang_id = $request->gudang_id;
                    $user->save();
                }else {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->gudang_id = $request->gudang_id;
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
                    $user->gudang_id = $request->gudang_id;
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
                    $user->gudang_id = $request->gudang_id;
                    $user->foto = $photo;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
            }
             DB::commit();
            \Session::flash('msg_success','Admin Berhasil Diubah!');
            return Redirect::route('superadmin.admin');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('superadmin.admin');
        }
    }
    public function deleteAdmin($id)
    {
        DB::beginTransaction();
        try {
            $cariAdmin = User::find($id);
            \File::delete(public_path('foto/'.$cariAdmin->foto));
            $admin = User::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Admin Berhasil Dihapus!');
            return Redirect::route('superadmin.admin');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('superadmin.admin');
        }
    }
    public function machine() {
        $title = 'Data Machine';
        $machine = Machine::all();
        return view('superadmin.machine', compact('title','machine'));
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
            return Redirect::route('superadmin.machine');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('superadmin.machine');
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
            return Redirect::route('superadmin.machine');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('superadmin.machine');
        }
    }
    public function deleteMachine($id)
    {
        DB::beginTransaction();
        try {
            $machine = Machine::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Machine Berhasil Dihapus!');
            return Redirect::route('superadmin.machine');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('superadmin.machine');
        }
    }
    public function hose() {
        $title = 'Data Hose';
        $hose = Product::all();
        $gudang = Gudang::all();
        $machine = Machine::all();
        $machineID = null;
        return view('superadmin.hose', compact('title','hose','gudang','machine','machineID'));
    }
    public function detailHose($id) {
        $title = 'Data Hose';
        $hose = Product::where('machine_id',$id)->get();
        $machineID = $id;
        $gudang = Gudang::all();
        $machine = Machine::all();
        return view('superadmin.hose', compact('title','hose','gudang','machine','machineID'));
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
            $hose->gudang_id = $request->gudang_id;
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
            return Redirect::route('superadmin.hose');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('superadmin.hose');
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
            $hose->gudang_id = $request->gudang_id;
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
            return Redirect::route('superadmin.hose');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('superadmin.hose');
        }
    }
    public function deleteHose($id)
    {
        DB::beginTransaction();
        try {
            $hose = Product::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Hose Berhasil Dihapus!');
            return Redirect::route('superadmin.hose');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('superadmin.hose');
        }
    }
    public function history() {
        $title = 'Data History';
        $history = History::all();
        return view('superadmin.history', compact('title','history'));
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
                    return Redirect::route('superadmin.hose');
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
            return Redirect::route('superadmin.hose');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('superadmin.hose');
        }
    }
}
