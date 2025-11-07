<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // PENTING: Untuk transaksi
use Illuminate\Support\Facades\Hash; // PENTING: Untuk hashing (meski otomatis di Model)

use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;

class UserController extends Controller
{
    public function index() {
        $user = User::with('roleUser.role')->get();
        return view('admin.user.index', compact('user'));
    }

    public function create() {
        $roles = Role::all();
        // Pastikan Anda mengimpor 'Role' di atas
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Metode utama untuk menyimpan data user baru.
     */
    public function store(Request $request) {
        
        // 1. Panggil Helper Validasi
        // Menggunakan helper validateUser yang sudah dimodifikasi untuk idrole
        $validatedData = $this->validateUser($request); 

        try {
            // 2. Panggil Helper Penyimpanan (transaksi User dan RoleUser)
            $this->createUserAndAssignRole($validatedData);

            // 3. Redirect dengan pesan sukses
            return redirect()->route('admin.user.index')
                             ->with('success', 'User berhasil ditambahkan dan role berhasil ditetapkan.');

        } catch (\Exception $e) {
            // Tangani error jika penyimpanan gagal
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['gagal_simpan' => 'Gagal menyimpan data user: ' . $e->getMessage()]);
        }
    }

    /**
     * Helper: Melakukan validasi data User (termasuk idrole).
     */
    protected function validateUser(Request $request, $id = null) {
        $uniqueRule = $id ? 
            'unique:user,email,' . $id . ',iduser' :
            'unique:user,email';

        return $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $uniqueRule],
            'password' => ['required', 'string', 'min:6'],
            // PENTING: Validasi idrole dari dropdown
            'idrole' => ['required', 'integer', 'exists:role,idrole'], 
        ], [
            'nama.required' => 'Nama wajib diisi.',
            // ... pesan validasi lainnya ...
            'email.unique' => 'Email sudah ada dalam database.',
            'password.min' => 'Password minimal 6 karakter.',
            'idrole.required' => 'Role wajib dipilih.',
            'idrole.exists' => 'Role yang dipilih tidak valid.',
        ]);
    }

    /**
     * Helper: Membuat data User dan menetapkan Role dalam transaksi.
     */
    protected function createUserAndAssignRole(array $data) {
        DB::beginTransaction();

        try {
            // A. Buat User baru (Model User menghash otomatis)
            $user = User::create([
                'nama' => $data['nama'],
                'email' => $data['email'],
                'password' => $data['password'], // Kirim plaintext, biarkan Model hash (karena ada casts)
            ]);
            
            // B. Tetapkan Role ke user baru (di tabel role_user)
            RoleUser::create([
                'iduser' => $user->iduser, 
                'idrole' => $data['idrole'], // Ambil idrole dari input form
            ]);
            
            DB::commit(); // Selesaikan transaksi

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua operasi jika gagal
            throw new \Exception("Penyimpanan transaksi user gagal: " . $e->getMessage()); 
        } 
    }

}