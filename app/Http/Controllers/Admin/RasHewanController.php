<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\RasHewan;
use App\Models\JenisHewan;

class RasHewanController extends Controller
{
    public function index() {
        $rasHewan = JenisHewan::with('rasHewan')->get();
        return view('admin.ras-hewan.index', compact('rasHewan'));
    }

    public function create() {
        $jenisHewan = JenisHewan::all();
        return view('admin.ras-hewan.create', compact('jenisHewan'));
    }

    public function store(Request $request) {
        $validatedData = $this->validateRasHewan($request);
        $rasHewan = $this->createRasHewan($validatedData);
        return redirect()->route('admin.ras-hewan.index')
                        ->with('success', 'Ras Hewan berhasil ditambahkan.');
    }

    private function validateRasHewan(Request $request, $id = null) {
        $uniqueRule = $id ? 
            'unique:ras_hewan,nama_ras,' . $id . ',idras_hewan' :
            'unique:ras_hewan,nama_ras';

        return $request->validate([
            'idjenis_hewan' => ['required', 'integer', 'exists:jenis_hewan,idjenis_hewan'],
            'nama_ras' => ['required', 'string', 'max:255', $uniqueRule],
        ], [
            'idjenis_hewan.required' => 'Jenis Hewan wajib dipilih.',
            'idjenis_hewan.exists' => 'Jenis Hewan yang dipilih tidak valid.',
            'nama_ras.required' => 'Nama Ras wajib diisi.',
            'nama_ras.string' => 'Nama Ras harus berupa string.',
            'nama_ras.max' => 'Nama Ras maksimal 255 karakter.',
            'nama_ras.unique' => 'Nama Ras sudah ada dalam database.',
        ]);
    }

    //helper membuat data baru ras hewan
    private function createRasHewan(array $data) {
        try {
            return RasHewan::create([
                'idjenis_hewan' => $data['idjenis_hewan'],
                'nama_ras' => $this->formatNamaRas($data['nama_ras']),
            ]);

        } catch (\Exception $e) {
            throw new \Exception("Gagal menyimpan data ras hewan: " . $e->getMessage());
        }
    }

    //helper format nama ras hewan
    private function formatNamaRas($namaRas) {
        return trim(ucwords(strtolower(trim($namaRas))));
    }
}