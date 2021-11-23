<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'quantity',
        'description',
        'unit_price',
    ];

    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }
}
