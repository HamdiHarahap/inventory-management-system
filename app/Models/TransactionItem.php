<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $fillable = [
        'transaction_type',
        'transaction_id',
        'product_id',
        'qty',
        'pric',
        'subtotal'
    ];

    public function incoming()
    {
        return $this->belongsTo(IncomingTransaction::class, 'transaction_id');
    }


    public function outgoing() 
    {
        return $this->belongsTo(OutgoingTransaction::class, 'transaction_id');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
