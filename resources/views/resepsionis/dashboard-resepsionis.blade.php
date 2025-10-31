<h1>Dashboard Resepsionis</h1>
Selamat Datang, {{ session('user_name') }}

<form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf 
    <button class="btn btn-danger" type="submit">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>
</form>