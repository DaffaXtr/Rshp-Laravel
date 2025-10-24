<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.home');
    }

    public function cekKoneksi()
    {
        try {
            \DB::connection()->getPdo();
            return "Koneksi database berhasil!";
        } catch (\Exception $e) {
            return "Gagal terkoneksi ke database: " . $e->getMessage();
        }
    }
}
