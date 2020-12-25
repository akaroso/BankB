<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Operation;



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
        $suma = $Account->get('balance');
        $Account->balance += $suma;
        $Account->save();
        //  $Account->update($request->all());

        //zapis do operacji po stronie nadawcy

        //wplyw na konto glowne
        $Account2 = Account::first();
        $Account2->balance += $suma;
        $Account2->save();

        //zapis do operacji po stronie odbiorcy

        $Account->operation()->create([
            'type' => 'Deposit',
            'amount' => $suma,
            'status' => 'Processed'

        ]);

        return $Account;
    }


    public function internaltransfer(Request $request, $id)
    {


        $accnumber = $request->get('acc_number');

        #pobranie z konta nadawcy
        $Account = Account::findOrFail($id);
        $suma = $request->get('balance');
        $Account->balance -= $suma;
        $Account->save();

        //zapis do operacji po stronie nadawcy

        $Account->operation()->create([
            'type' => 'Expanse',
            'amount' => -$suma,
            'status' => 'Processed',
        ]);


        $Account2 = Account::where('number', $accnumber)->first();
        $suma = $request->get('balance');
        $Account2->balance += $suma;
        $Account2->save();


        //zapis do operacji po stronie odbiorcy

        $Account2->operation()->create([
            'type' => 'Income',
            'amount' => $suma,
            'status' => 'Processed'
        ]);

        return $Account;
    }


    public function delete(Request $request, $id)
    {
        $Account = Account::findOrFail($id);
        $Account->delete();

        return 204;
    }
}
