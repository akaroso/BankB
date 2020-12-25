<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneratorController extends Controller
{
    
    

    public function generateControlNumber(string $number) : int
{

    $number = env('BANK_NUMBER');

    $weights=[3,9,7,1,3,9,7];

    $sum = 0;

    for ($i=0; $i < strlen($number); $i++){
        $sum += $number[$i]*$weights[$i];
    }
    
    if($sum != 0){
    $controlSum = 10 - $sum%10;
    }

    

    return $controlSum;
}   

public function generateControlNumberWithNumber(string $number) : string
{




    $controlSum = $this->generateControlNumber($number);

    return $number.$controlSum;
}

public function mod97(string $iban)
{
    $mod = 0;
    for ($i=0; $i < round(strlen($iban)/6); $i++) {
        $currentString = substr($iban, $i*6, 6);
        $currentStringWithModulo = $mod.$currentString;
        $mod = $i ? ($mod . substr($iban, $i*6, 6))%97 : $currentString%97;
    }

    return $mod;
}

public function generateIbanControlNumber(string $iban) : string
{


    $mod = $this->mod97($iban);
    return 98-$mod;
}

public function generateIban() : string
{
    $number = env('BANK_NUMBER');
    
    $iban = $this->generateControlNumberWithNumber($number). str_pad(mt_rand(0,99999999),8,'0',STR_PAD_LEFT) . str_pad(mt_rand(0,99999999),8,'0',STR_PAD_LEFT);

    $p = ord("P") - 55;
    $l = ord("L") - 55;

    $fullIban = $iban.$p.$l."00";

    $controlSum = $this->generateIbanControlNumber($fullIban);
     
    
   // return $controlSum;
    return "PL".$controlSum.$iban;
}

function validateNumber($number ){

    
    $p = ord(substr($number,0, 1)) -55;
    $l = ord(substr($number,1, 2)) -55;
    $part1 = substr($number,2, 2);
    $part2 = substr($number, 4);
    
    $number = $part2.$p.$l.$part1;

    //wew
    $mod = 0;
    for ($i=0; $i < round(strlen($number)/6); $i++) {
        $currentString = substr($number, $i*6, 6);
        $currentStringWithModulo = $mod.$currentString;
        $mod = $i ? ($mod . substr($number, $i*6, 6))%97 : $currentString%97;
    }

    if ($mod == 1){
        return true;
    }else{
        return false;
    }

}

public function insideCheck($number)
{
    $number = substr($number,4, 7);
    if($number == env('BANK_NUMBER')){
        return true;
    }else{
        return false;
    }
}
}
