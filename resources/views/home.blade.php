@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} - {{ session('user_name') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} {{ session('user_role_name') }}

                    <div class="mt-4">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-users"></i> Manage Users
                                </a>
                            </div>
                            <div class="col-md-12 mb-2">
                                <a href="{{ route('admin.role.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-user-shield"></i> Manage Roles
                                </a>
                            </div>
                            <div class="col-md-12 mb-2">
                                <a href="{{ route('admin.pet.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-paw"></i> Manage Pets
                                </a>
                            </div>
                            <div class="col-md-12 mb-2">
                                <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-jenis"></i> Manage jenis Hewan
                                </a>
                            </div>
                            <div class="col-md-12 mb-2">
                                <a href="{{ route('admin.kategori.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-jenis"></i> Manage Kategori
                                </a>
                            </div>
                            <div class="col-md-12 mb-2">
                                <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-jenis"></i> Manage Kategori Klinis
                                </a>
                            </div>
                            <div class="col-md-12 mb-2">
                                <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-jenis"></i> Manage Kode Tindakan Terapi
                                </a>
                            </div>
                            <div class="col-md-12 mb-2">
                                <a href="{{ route('admin.pemilik.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-jenis"></i> Manage Pemilik Hewan
                                </a>
                            </div>
                            <div class="col-md-12 mb-2">
                                <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-primary btn-block">
                                    <i class="fas fa-jenis"></i> Manage Ras Hewan
                                </a>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf 
                                <button class="btn btn-danger" type="submit">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
