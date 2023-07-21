<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        // $this->middleware(['auth','verified'])->except('index');
        // $this->middleware(['auth','verified'])->only('index');
        $this->middleware(['auth','verified']);
    }
    public function index(){
        $name = Auth::user()->name ;
        return view('admin.index' , compact('name'));
    }

    public function redirect(){
        $user = Auth::user()->role ; 
        if ($user == 'admin' || $user == "super_admin") {
            return redirect()->route('dashboard');
        }elseif ($user == 'user') {
            return redirect()->route('front.home');
        }

    }
}
