@extends('layouts.app')

@section('content')
<div class="container-fluid">
    {{-- Header Halaman --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-cat me-2"></i> Data Ras Hewan
        </h1>
        <a href="{{ route('admin.ras-hewan.create') }}" class="btn btn-primary btn-sm shadow-sm" style="background-color: var(--primary-blue); border-color: var(--primary-blue);">
            <i class="fas fa-plus fa-sm text-white"></i> Tambah Ras Hewan
        </a>
    </div>

    {{-- Pesan Sukses (Opsional, tergantung implementasi Controller) --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Card untuk Tabel --}}
    <div class="card shadow mb-4 border-0 rounded-3">
        <div class="card-header py-3 bg-white rounded-top-3">
            <h6 class="m-0 fw-bold" style="color: var(--primary-blue);">Daftar Ras Hewan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{-- Modifikasi Struktur Tabel --}}
                <table class="table" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center">ID Ras</th>
                            <th>Nama Jenis Hewan</th>
                            <th>Nama Ras</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop utama untuk mengiterasi Jenis Hewan --}}
                        @foreach ($rasHewan as $jenis)
                            @php 
                                // Hitung jumlah ras, minimal 1 untuk kasus 'Belum Punya Ras'
                                $rasCount = $jenis->rasHewan->count();
                                $rowspan = max(1, $rasCount);
                            @endphp

                            @if ($rasCount > 0)
                                {{-- KONDISI 1: Jenis Hewan MEMILIKI Ras (Looping Ras) --}}
                                @foreach ($jenis->rasHewan as $index => $ras)
                                    <tr>
                                        <td class="text-center">{{ $ras->idras_hewan }}</td>

                                        {{-- Tampilkan Nama Jenis hanya di baris pertama dengan rowspan --}}
                                        @if ($index === 0)
                                            <td rowspan="{{ $rowspan }}" class="fw-bold align-middle">
                                                {{ $jenis->nama_jenis_hewan }}
                                            </td>
                                        @endif

                                        <td>{{ $ras->nama_ras }}</td>
                                        
                                        {{-- Kolom Aksi (untuk Ras) --}}
                                        <td class="text-center">
                                            {{-- Tombol Edit Ras --}}
                                            <a href="#" class="btn btn-sm btn-info me-1" title="Edit" style="color: white; background-color: var(--primary-blue); border-color: var(--primary-blue);">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            {{-- Tombol Hapus Ras --}}
                                            <form action="#" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus Ras {{ $ras->nama_ras }}?')" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                {{-- KONDISI 2: Jenis Hewan TIDAK MEMILIKI Ras (Baris Tunggal) --}}
                                <tr>
                                    <td class="text-center">-</td> {{-- ID Ras dikosongkan --}}
                                    
                                    {{-- Nama Jenis Hewan ditampilkan --}}
                                    <td class="fw-bold align-middle">
                                        {{ $jenis->nama_jenis_hewan }}
                                    </td>

                                    {{-- Kolom Nama Ras berisi keterangan --}}
                                    <td><span class="text-muted fst-italic">Belum Punya Ras</span></td>
                                    
                                    {{-- Kolom Aksi (untuk Jenis Hewan) --}}
                                    <td class="text-center">
                                         {{-- Tombol Tambah Ras untuk Jenis ini --}}
                                        <a href="#" class="btn btn-sm btn-info me-1" title="Edit" style="color: white; background-color: var(--primary-blue); border-color: var(--primary-blue);">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        {{-- Tombol Edit Jenis Hewan (asumsi Anda memiliki route admin.jenis-hewan.edit) --}}
                                        <a href="#" class="btn btn-sm btn-danger me-1" title="Hapus">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                {{-- Akhir Modifikasi Struktur Tabel --}}
            </div>
        </div>
    </div>
</div>
@endsection