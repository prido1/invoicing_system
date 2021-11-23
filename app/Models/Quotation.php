<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'create_date',
        'due_date',
        'note',
        'terms_condition',
        'discount',
        'payment_type',
        'payment_currency',
    ];

    protected $casts = [
        'create_date' => 'date',
    ];

    public function paymentType(){
        return $this->belongsTo(PaymentType::class, 'payment_type');
    }

    public function paymentCurrency(){
        return $this->belongsTo(PaymentCurrency::class, 'payment_currency');
    }

    public function items()
    {
        return $this->hasMany(QuotationItem::class, 'quotation_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
