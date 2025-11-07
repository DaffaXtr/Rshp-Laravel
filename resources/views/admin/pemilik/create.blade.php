@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-tag me-2"></i> Tambah Pemilik Hewan
        </h1>
        <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    {{-- Pesan Sukses (Jika redirect dari controller) --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
            <h6 class="m-0 fw-bold" style="color: var(--primary-blue);">Formulir Pendaftaran Pemilik Baru</h6>
        </div>
        <div class="card-body">
            
            {{-- Form untuk menyimpan data baru --}}
            {{-- Sesuaikan 'admin.pemilik.store' dengan route yang benar --}}
            <form action="{{ route('admin.pemilik.store') }}" method="POST">
                @csrf

                <h5 class="fw-bold mb-3 mt-2 text-primary" style="color: var(--secondary-blue) !important;">
                    Data Login (User)
                </h5>
                <hr class="mt-0">

                {{-- Input: Nama Lengkap (untuk tabel users) --}}
                <div class="mb-3">
                    <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                    <input type="text" 
                           class="form-control @error('nama') is-invalid @enderror" 
                           id="nama" 
                           name="nama" 
                           value="{{ old('nama') }}" 
                           placeholder="Masukkan Nama Lengkap Pemilik" 
                           required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- Input: Email (untuk tabel users) --}}
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

                {{-- Input: Password (untuk tabel users) --}}
                <div class="mb-4">
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

                <h5 class="fw-bold mb-3 mt-4 text-primary" style="color: var(--secondary-blue) !important;">
                    Data Kontak dan Alamat
                </h5>
                <hr class="mt-0">
                
                {{-- Input: No. WA (untuk tabel pemilik) --}}
                <div class="mb-3">
                    <label for="no_wa" class="form-label fw-bold">Nomor WhatsApp</label>
                    <input type="text" 
                           class="form-control @error('no_wa') is-invalid @enderror" 
                           id="no_wa" 
                           name="no_wa" 
                           value="{{ old('no_wa') }}" 
                           placeholder="Contoh: 081234567890" 
                           required>
                    @error('no_wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                {{-- Input: Alamat (untuk tabel pemilik) --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label fw-bold">Alamat Lengkap</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                              id="alamat" 
                              name="alamat" 
                              rows="3" 
                              placeholder="Masukkan Alamat Lengkap Pemilik" 
                              required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" 
                            class="btn btn-primary shadow-sm"
                            style="background-color: var(--primary-blue); border-color: var(--primary-blue);">
                        <i class="fas fa-save me-2"></i> Simpan Data Pemilik
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection