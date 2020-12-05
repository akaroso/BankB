<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Account;

class AccountController extends Controller
{
    
    public function index()
    {
        return Account::all();
    }

    public function show($id)
    {
        return Account::find($id);
    }

    public function store(Request $request)
    {
        return Account::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $Account = Account::findOrFail($id);
        $Account->update($request->all());

        return $Account;
    }

    public function delete(Request $request, $id)
    {
        $Account = Account::findOrFail($id);
        $Account->delete();

        return 204;
    }

}
