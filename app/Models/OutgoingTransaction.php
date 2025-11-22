<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutgoingTransaction extends Model
{
    protected $fillable = [
        'customer_id',
        'user_id',
        'date',
        'notes'
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class, 'transaction_id')->where('transaction_type', 'outgoing');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
