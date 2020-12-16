<?php

namespace App\Http\Controllers;
Use App\Models\Operation;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function index()
    {
        return Operation::all();
    }

    public function show($id)
    {
        return Operation::find($id);
    }
}
