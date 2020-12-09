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
        $suma = $request->get('balance');
        $Account->balance += $suma;
        $Account->save();
      //  $Account->update($request->all());
    
      //zapis do operacji

       $Account2 = Account::first();
       $Account2->balance += $suma;
       $Account2->save();
    
        //zapis do operacji
      
        return $Account;
    }

    public function delete(Request $request, $id)
    {
        $Account = Account::findOrFail($id);
        $Account->delete();

        return 204;
    }

}
