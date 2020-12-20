<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Account;
Use App\Models\Operation;

class MoneyWebController extends Controller
{


    public function depositMoney(Request $request )

    {
        $id = $request->get('id');

        $Account = Account::findOrFail($id);
        $suma = $request->get('balance');
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
            'type'=>'Deposit',
            'amount'=>$suma,
            'status'=>'Processed'
            
        ]);

        return redirect('/dashboard')->with('success', 'Przelew wykonany!');
    }

    public function internalTransfer(Request $request)

    {
        $id = $request->get('id');
        
        $request->validate([
            'balance'=>'required',
            'acc_number'=>'required',
        ]);
        
        $accnumber = $request->get('acc_number');

        #pobranie z konta nadawcy
        $Account = Account::findOrFail($id);
        $suma = $request->get('balance');
        $Account->balance -= $suma;
        $Account->save();

        //zapis do operacji po stronie nadawcy

        $Account->operation()->create([
            'type'=>'Expanse',
            'amount'=>-$suma,
            'status'=>'Processed',                  
        ]);
      

        $Account2 = Account::where('number',$accnumber)->first();
        $suma = $request->get('balance');
        $Account2->balance += $suma;
        $Account2->save();
       
     
        //zapis do operacji po stronie odbiorcy
        
        $Account2->operation()->create([
            'type'=>'Income',
            'amount'=>$suma,
            'status'=>'Processed'
        ]);
        

        return redirect('/dashboard')->with('success', 'Przelew wykonany!');
    }

    public function externalTransfer(Request $request)

    {
        $id = $request->get('id');
        
        return redirect('/dashboard')->with('success', 'Przelew wykonany!');
    }
}
