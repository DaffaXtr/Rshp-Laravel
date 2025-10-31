@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-dog me-2"></i> Manajemen Jenis Hewan
        </h1>
        <a href="#" class="btn btn-primary btn-sm shadow-sm" style="background-color: var(--primary-blue); border-color: var(--primary-blue);">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4 border-0 rounded-3">
        <div class="card-header py-3 bg-white rounded-top-3">
            <h6 class="m-0 fw-bold" style="color: var(--primary-blue);">Daftar Jenis Hewan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center">ID Jenis Hewan</th>
                            <th>Nama Jenis</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenisHewan as $jenis)
                            <tr>
                                <td class="text-center">{{ $jenis->idjenis_hewan }}</td>
                                <td>{{ $jenis->nama_jenis_hewan }}</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-info me-2 shadow-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Tambahkan pagination jika diperlukan -->
            {{-- <div class="mt-3">
                {{ $jenisHewan->links() }}
            </div> --}}
        </div>
    </div>
</div>
@endsection
