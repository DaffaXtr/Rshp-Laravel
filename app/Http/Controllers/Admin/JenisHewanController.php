<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JenisHewan;

class JenisHewanController extends Controller
{
    public function index() {
        $jenisHewan = JenisHewan::all();
        return view('admin.jenis-hewan.index', compact('jenisHewan'));
    }

    public function create() {
        return view('admin.jenis-hewan.create');
    }

    public function store(Request $request) {
        $validatedData = $this->validateJenisHewan($request);
        $jenisHewan = $this->createJenisHewan($validatedData);
        return redirect()->route('admin.jenis-hewan.index')
                        ->with('success', 'Jenis Hewan berhasil ditambahkan.');
    }

    protected function validateJenisHewan(Request $request, $id = null) {
        $uniqueRule = $id ? 
            'unique:jenis_hewan,nama_jenis_hewan,' . $id . ',idjenis_hewan' :
            'unique:jenis_hewan,nama_jenis_hewan';

        return $request->validate([
            'nama_jenis_hewan' => [
                'required',
                'string',
                'max:255',
                'min:3',
                $uniqueRule,
            ],
        ], [
            'nama_jenis_hewan.required' => 'Nama Jenis Hewan wajib diisi.',
            'nama_jenis_hewan.string' => 'Nama Jenis Hewan harus berupa string.',
            'nama_jenis_hewan.max' => 'Nama Jenis Hewan maksimal 255 karakter.',
            'nama_jenis_hewan.min' => 'Nama Jenis Hewan minimal 3 karakter.',
            'nama_jenis_hewan.unique' => 'Nama Jenis Hewan sudah ada dalam database.',
        ]);
    }

    //helper membuat data baru jenis hewan
    protected function createJenisHewan(array $data) {
        try {
            return JenisHewan::create([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
            ]);
        } catch (\Exception $e) {
            throw new \Exception("Gagal menyimpan data jenis hewan: " . $e->getMessage());
        }
    }

    //helper untuk memformat nama jenis hewan menjadi Title Case
    protected function formatNamaJenisHewan($nama) {
        return trim(ucwords(strtolower($nama)));
    }
}
