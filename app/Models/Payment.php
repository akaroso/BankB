<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'DebitedAccountNumber',
        'DebitedNameAndAddress',
        'CreditedAccountNumber',
        'CreditedNameAndAddress', 
        'Title',
        'Amount'         
    ];

    public function paymentStorage()
    {
        return $this->belongsTo('App\Models\PaymentStorage')
        ;        
    }

}
