@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
    {{-- 1. Header dan Tombol Tambah --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-stethoscope me-2"></i> Manajemen Kategori Klinis
        </h1>
        {{-- Ganti route ke halaman create yang sesuai --}}
        <a href="#" class="btn btn-primary btn-sm shadow-sm" style="background-color: var(--primary-blue); border-color: var(--primary-blue);">
            <i class="fas fa-plus fa-sm text-white"></i> Tambah Data
        </a>
    </div>

    {{-- 2. Pesan Sukses (Success Alert) --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- 3. Card Container untuk Tabel --}}
    <div class="card shadow mb-4 border-0 rounded-3">
        <div class="card-header py-3 bg-white rounded-top-3">
            <h6 class="m-0 fw-bold" style="color: var(--primary-blue);">Daftar Kategori Klinis</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center">ID Kategori Klinis</th>
                            <th>Nama Kategori Klinis</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoriKlinis as $kat)
                            <tr>
                                <td class="text-center">{{ $kat->idkategori_klinis }}</td>
                                <td>{{ $kat->nama_kategori_klinis }}</td>
                                
                                {{-- Kolom Aksi --}}
                                <td class="text-center" style="min-width: 120px;">
                                    {{-- Ganti route edit --}}
                                    <a href="#" class="btn btn-sm btn-info me-1 shadow-sm" style="color: white; background-color: var(--primary-blue); border-color: var(--primary-blue);">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    
                                    {{-- Ganti route destroy --}}
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori klinis ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection