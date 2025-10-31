<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('home');
    }

    public function home()
    {
        return view('home');
    }

    public function index()
    {
        return view('dashboard');
    }

    public function struktur() {
        return view('struktur');
    }

    public function layanan() {
        return view('layanan');
    }

    public function visi() {
        return view('visi');
    }

    public function login() {
        return view('login');
    }
}
