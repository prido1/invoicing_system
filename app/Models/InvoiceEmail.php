<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceEmail extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'sent',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'date',
        'sent' => 'boolean',
    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
