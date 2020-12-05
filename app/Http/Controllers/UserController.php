<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function store(Request $request)
    {
        return User::create($request->all());   
    }

    public function createUser(Request $request)
    {
        
     //   $konto = \App\Models\Account::factory()->create();
        $login = User::create($request->all());
        
        $login->account()->create([
            'number'=>"12345",
            'balance'=>0
        ]);
        

            return $login;
      //  return response()->json(['updated' => $konto->load(['number'])], 200);
    }




  //  public function saveforcustromer(Request $request, $id)
  //  {
    //    $custromer = Kontrahent::firstWhere('id',$id);
   //     $produkt_id = $request -> get('produkt_id');
    //    $produkt = Produkt::firstWhere('id');
    //    $cena = $request->get('cena');
   //     $custromer->produkt_kontrahent()->attach($produkt_id,['cena'=>$cena]);
    //    $custromer -> save();
    //    return response()->json(['updated' => $custromer->load(['produkt_kontrahent'])], 200);

   // }

}
