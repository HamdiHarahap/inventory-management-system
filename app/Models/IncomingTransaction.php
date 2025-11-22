<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingTransaction extends Model
{
    protected $fillable = [
        'supplier_id',
        'user_id',
        'date',
        'notes'
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class, 'transaction_id')->where('transaction_type', 'incoming');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
