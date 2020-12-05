<?php

namespace App\Http\Controllers;
Use App\Models\User;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::find($id);
    }
}
