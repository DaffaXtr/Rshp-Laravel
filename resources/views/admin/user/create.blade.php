@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-users me-2"></i> Tambah User Baru
        </h1>
        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    {{-- Pesan Sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tampilkan Error Validasi Umum --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Kartu untuk Form --}}
    <div class="card shadow mb-4 border-0 rounded-3">
        <div class="card-header py-3 bg-white rounded-top-3">
            <h6 class="m-0 fw-bold" style="color: var(--primary-blue);">Formulir Data User</h6>
        </div>
        <div class="card-body">
            
            {{-- Form untuk menyimpan data baru --}}
            {{-- Sesuaikan 'admin.user.store' dengan route yang benar --}}
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf

                {{-- Input: Nama Lengkap --}}
                <div class="mb-3">
                    <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama') }}" 
                           placeholder="Masukkan Nama Lengkap User" 
                           required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- Input: Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="Masukkan Email (digunakan untuk login)" 
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input: Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password" 
                           placeholder="Masukkan Password (minimal 6 karakter)" 
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- Input: Role (Dropdown) --}}
                <div class="mb-4">
                    <label for="idrole" class="form-label fw-bold">Pilih Role</label>
                    <select class="form-select @error('idrole') is-invalid @enderror" 
                            id="idrole" 
                            name="idrole" 
                            required>
                        <option value="" disabled selected>-- Pilih Role Pengguna --</option>
                        
                        {{-- Logika Looping untuk Roles --}}
                        {{-- PENTING: Variabel $roles harus dikirimkan dari Controller --}}
                        @isset($roles)
                            @foreach ($roles as $role)
                                <option value="{{ $role->idrole }}" 
                                        {{ old('idrole') == $role->idrole ? 'selected' : '' }}>
                                    {{ $role->nama_role }}
                                </option>
                            @endforeach
                        @else
                            <option value="" disabled>Data Role tidak tersedia</option>
                        @endisset

                    </select>

                    @error('idrole')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" 
                            class="btn btn-primary shadow-sm"
                            style="background-color: var(--primary-blue); border-color: var(--primary-blue);">
                        <i class="fas fa-save me-2"></i> Simpan User
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection