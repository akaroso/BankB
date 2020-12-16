<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;
Use App\Http\Controllers\GeneratorController;

use function App\Services\generateControlNumber;
use function App\Services\generateIban;

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
        
    
      
      $numer =  app('App\Http\Controllers\GeneratorController')->generateIban();

    
        $login->account()->create([
            'number'=>$numer,
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
