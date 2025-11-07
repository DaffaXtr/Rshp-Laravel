@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-dog me-2"></i> Tambah Jenis Hewan
        </h1>
        <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>
    
    {{-- Menampilkan pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Kartu untuk Form --}}
    <div class="card shadow mb-4 border-0 rounded-3">
        <div class="card-header py-3 bg-white rounded-top-3">
            <h6 class="m-0 fw-bold" style="color: var(--primary-blue);">Formulir Jenis Hewan Baru</h6>
        </div>
        <div class="card-body">
            
            {{-- Form untuk menyimpan data baru --}}
            {{-- Sesuaikan 'admin.jenis-hewan.store' dengan route yang benar di web.php Anda --}}
            <form action="{{ route('admin.jenis-hewan.store') }}" method="POST">
                @csrf

                {{-- Input untuk nama_jenis_hewan --}}
                <div class="mb-3">
                    <label for="nama_jenis_hewan" class="form-label fw-bold">Nama Jenis Hewan</label>
                    <input type="text" 
                           class="form-control @error('nama_jenis_hewan') is-invalid @enderror" 
                           id="nama_jenis_hewan" 
                           name="nama_jenis_hewan" 
                           value="{{ old('nama_jenis_hewan') }}" 
                           placeholder="Masukkan Nama Jenis Hewan" 
                           required>

                    {{-- Menampilkan pesan error validasi --}}
                    @error('nama_jenis_hewan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" 
                            class="btn btn-primary shadow-sm"
                            style="background-color: var(--primary-blue); border-color: var(--primary-blue);">
                        <i class="fas fa-save me-2"></i> Simpan Data
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection