@extends('layouts.app')

@section('content')
<div class="container-fluid">
    
    {{-- 1. Header dan Tombol Tambah --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-syringe me-2"></i> Manajemen Kode Tindakan/Terapi
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
            <h6 class="m-0 fw-bold" style="color: var(--primary-blue);">Daftar Kode Tindakan/Terapi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center" style="width: 5%;">ID</th>
                            <th style="width: 10%;">Kode</th>
                            <th>Deskripsi</th>
                            <th style="width: 15%;">Kategori</th>
                            <th style="width: 15%;">Kategori Klinis</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Kelompokkan data berdasarkan Kategori Klinis dan Kategori
                            $grouped = $kodeTindakanTerapi->groupBy([
                                'kategoriKlinis.nama_kategori_klinis',
                                'kategori.nama_kategori'
                            ]);
                        @endphp

                        @foreach ($grouped as $namaKlinis => $kategoriGroup)
                            @php
                                // Hitung total baris dalam kategori klinis ini (untuk rowspan klinis)
                                $rowspanKlinis = $kategoriGroup->flatten(1)->count();
                                $isFirstKlinis = true;
                            @endphp

                            @foreach ($kategoriGroup as $namaKategori => $kodeList)
                                @php
                                    $rowspanKategori = $kodeList->count();
                                    $isFirstKategori = true;
                                @endphp

                                @foreach ($kodeList as $kode)
                                    <tr>
                                        <td class="text-center">{{ $kode->idkode_tindakan_terapi }}</td>
                                        <td>{{ $kode->kode }}</td>
                                        <td>{{ $kode->deskripsi_tindakan_terapi }}</td>

                                        {{-- Tampilkan Kategori (rowspan) --}}
                                        @if ($isFirstKategori)
                                            <td rowspan="{{ $rowspanKategori }}" class="align-middle fw-bold">{{ $namaKategori }}</td>
                                        @endif
                                        
                                        {{-- Tampilkan Kategori Klinis (rowspan) --}}
                                        @if ($isFirstKlinis)
                                            <td rowspan="{{ $rowspanKlinis }}" class="align-middle fw-bold bg-light">{{ $namaKlinis }}</td>
                                        @endif

                                        {{-- Kolom Aksi --}}
                                        <td class="text-center" style="min-width: 120px;">
                                            {{-- Ganti route edit --}}
                                            <a href="#" class="btn btn-sm btn-info me-1 shadow-sm" style="color: white; background-color: var(--primary-blue); border-color: var(--primary-blue);">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            {{-- Ganti route destroy --}}
                                            <form action="#" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Yakin hapus kode tindakan ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    @php 
                                        $isFirstKategori = false; 
                                        $isFirstKlinis = false; // Hanya di set false setelah baris pertama kategori klinis dicetak
                                    @endphp
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection