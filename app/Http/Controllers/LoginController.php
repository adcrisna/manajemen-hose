<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Machine;
use App\Models\Product;
use App\Models\History;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function prosesLogin(Request $request)
    {
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            if (Auth::User()->role == "Super Admin")
            {
                return \Redirect::to('/superadmin/home');
            }
            elseif (Auth::User()->role == "Admin")
            {
                return \Redirect::to('/admin/home');
            }
            elseif (Auth::User()->role == "User")
            {
                return \Redirect::to('/user/home');
            }
        }
        else
        {
            \Session::flash('msg_login','Email Atau Password Salah!');
            return \Redirect::to('/');
        }
    }
    public function logout(){
        Auth::logout();
      return \Redirect::to('/');
    }
    function pdfProduct(Request $request)
    {
        $tanggalAwal = date('Y-m-d', strtotime($request->tanggalAwal));
        $tanggalAkhir = date('Y-m-d', strtotime($request->tanggalAkhir));
        if (empty($request->machineID)) {
           if (Auth::user()->role != 'Super Admin') {
            $hose = Product::whereBetween('date', [date('Y-m-d', strtotime($request->tanggalAwal)), date('Y-m-d', strtotime($request->tanggalAkhir))])
            ->where('gudang_id', Auth::user()->gudang_id)->get();
            }else {
                $hose = Product::whereBetween('date', [date('Y-m-d', strtotime($request->tanggalAwal)), date('Y-m-d', strtotime($request->tanggalAkhir))])->get();
            }
        }else {
            if (Auth::user()->role != 'Super Admin') {
            $hose = Product::whereBetween('date', [date('Y-m-d', strtotime($request->tanggalAwal)), date('Y-m-d', strtotime($request->tanggalAkhir))])
            ->where('gudang_id', Auth::user()->gudang_id)->where('machine_id',$request->machineID)->get();
            }else {
                $hose = Product::whereBetween('date', [date('Y-m-d', strtotime($request->tanggalAwal)), date('Y-m-d', strtotime($request->tanggalAkhir))])
                ->where('machine_id',$request->machineID)->get();
            }
        }
        $pdf = Pdf::loadView('pdf.hose', compact('hose','tanggalAwal','tanggalAkhir'))->setPaper('a4','landscape');
        return $pdf->stream();
    }
    function pdfProductByID($id)
    {
        $hose = Product::find($id);
        $pdf = Pdf::loadView('pdf.hoseByID', compact('hose'));
        return $pdf->stream();
    }
    function pdfHistory(Request $request)
    {
        $history = History::whereBetween('created_at', [date('Y-m-d', strtotime($request->tanggalAwal)), date('Y-m-d', strtotime($request->tanggalAkhir))])->get();
        $pdf = Pdf::loadView('pdf.history', compact('history'));
        return $pdf->stream();
    }
}
