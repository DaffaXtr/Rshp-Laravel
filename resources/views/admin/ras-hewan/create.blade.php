@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-cat me-2"></i> Tambah Ras Hewan
        </h1>
        {{-- Sesuaikan route ini dengan route index Ras Hewan Anda --}}
        <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary btn-sm shadow-sm">
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

    {{-- Kartu untuk Form --}}
    <div class="card shadow mb-4 border-0 rounded-3">
        <div class="card-header py-3 bg-white rounded-top-3">
            <h6 class="m-0 fw-bold" style="color: var(--primary-blue);">Formulir Ras Hewan Baru</h6>
        </div>
        <div class="card-body">
            
            {{-- Form untuk menyimpan data baru --}}
            {{-- Sesuaikan 'admin.ras-hewan.store' dengan route yang benar di web.php Anda --}}
            <form action="{{ route('admin.ras-hewan.store') }}" method="POST">
                @csrf

                {{-- Input untuk idjenis_hewan (Dropdown) --}}
                <div class="mb-3">
                    <label for="idjenis_hewan" class="form-label fw-bold">Jenis Hewan</label>
                    <select class="form-select @error('idjenis_hewan') is-invalid @enderror" 
                            id="idjenis_hewan" 
                            name="idjenis_hewan" 
                            required>
                        <option value="" disabled selected>-- Pilih Jenis Hewan --</option>
                        
                        {{-- Logika Looping untuk Jenis Hewan --}}
                        {{-- PENTING: Variabel $jenisHewan harus dikirimkan dari Controller --}}
                        @isset($jenisHewan)
                            @foreach ($jenisHewan as $jenis)
                                <option value="{{ $jenis->idjenis_hewan }}" 
                                        {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis_hewan }}
                                </option>
                            @endforeach
                        @else
                            {{-- Tampilkan jika variabel $jenisHewan belum dikirimkan --}}
                            <option value="" disabled>Data Jenis Hewan tidak tersedia</option>
                        @endisset

                    </select>

                    {{-- Menampilkan pesan error validasi --}}
                    @error('idjenis_hewan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Input untuk nama_ras --}}
                <div class="mb-3">
                    <label for="nama_ras" class="form-label fw-bold">Nama Ras Hewan</label>
                    <input type="text" 
                           class="form-control @error('nama_ras') is-invalid @enderror" 
                           id="nama_ras" 
                           name="nama_ras" 
                           value="{{ old('nama_ras') }}" 
                           placeholder="Masukkan Nama Ras Hewan (misal: Persia, Golden)" 
                           required>

                    {{-- Menampilkan pesan error validasi --}}
                    @error('nama_ras')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" 
                            class="btn btn-primary shadow-sm"
                            style="background-color: var(--primary-blue); border-color: var(--primary-blue);">
                        <i class="fas fa-save me-2"></i> Simpan Data Ras
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection