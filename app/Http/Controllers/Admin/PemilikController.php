<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Pemilik;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;

class PemilikController extends Controller
{
    public function index() {
        $pemilik = Pemilik::all();
        return view('admin.pemilik.index', compact('pemilik'));
    }

    public function create() {
        return view('admin.pemilik.create');
    }

    public function store(Request $request) {
        
        // 1. Panggil Helper Validasi
        $validatedData = $this->validatePemilik($request);

        try {
            // 2. Panggil Helper Penyimpanan (termasuk transaksi User dan Pemilik)
            $this->createPemilikAndUser($validatedData);

            // 3. Redirect dengan pesan sukses
            return redirect()->route('admin.pemilik.index')
                             ->with('success', 'Data Pemilik baru berhasil ditambahkan.');

        } catch (\Exception $e) {
            // Tangani error jika penyimpanan gagal (rollback otomatis sudah dilakukan di helper)
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['gagal_simpan' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }

    /**
     * Helper: Melakukan validasi data Pemilik.
     */
    protected function validatePemilik(Request $request, $id = null) {
        
        // Aturan validasi unik untuk email dan no_wa
        $emailUniqueRule = $id ? 
            'unique:user,email,' . $id . ',iduser' :
            'unique:user,email';
        
        $waUniqueRule = $id ?
            'unique:pemilik,no_wa,' . $id . ',idpemilik' :
            'unique:pemilik,no_wa';

        return $request->validate([
            // Validasi untuk tabel User
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $emailUniqueRule], 
            'password' => ['required', 'string', 'min:6'],
            
            // Validasi untuk tabel Pemilik
            'no_wa' => ['required', 'string', 'max:15', $waUniqueRule], 
            'alamat' => ['required', 'string', 'max:500'],
        ], [
            // Pesan kustom
            'email.unique' => 'Email ini sudah terdaftar. Gunakan email lain.',
            'no_wa.unique' => 'Nomor WhatsApp ini sudah terdaftar.',
            'password.min' => 'Password minimal 6 karakter.',
            'required' => 'Field :attribute wajib diisi.',
            // ... 
        ]);
    }

    protected function createPemilikAndUser(array $data) {
        DB::beginTransaction();

        try {
            // A. Buat User baru
            $user = User::create([
                'nama' => $data['nama'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);
            
            // B. Tetapkan Role 'Pemilik'
            $rolePemilik = Role::where('nama_role', 'pemilik')->first(); 
            
            if ($rolePemilik) {
                // Asumsi field primary key di User adalah 'iduser'
                RoleUser::create([ 
                    'iduser' => $user->iduser, 
                    'idrole' => $rolePemilik->idrole,
                ]);
            } else {
                throw new \Exception("Role 'Pemilik' tidak ditemukan. Mohon buat role ini terlebih dahulu.");
            }

            // C. Buat Pemilik baru
            Pemilik::create([
                'iduser' => $user->iduser, 
                'no_wa' => $data['no_wa'],
                'alamat' => $data['alamat'],
            ]);

            DB::commit(); // Selesaikan transaksi jika semua berhasil

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua operasi jika terjadi error
            // Lempar exception agar ditangkap oleh method store
            throw new \Exception("Penyimpanan transaksi gagal: " . $e->getMessage()); 
        }
    }
}
