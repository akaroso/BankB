<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStorage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'BankNo',
        'PaymentSum'               
    ];

    public function payment()
    {
    return $this->hasMany('App\Models\payment');
    }



}
