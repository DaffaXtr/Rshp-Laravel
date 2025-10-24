<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Role;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }
}
