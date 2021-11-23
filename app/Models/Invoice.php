<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
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
        'payment_status',
        'send_interval',
        'send_date',
        'email_subject',
        'email_body',
        'attach',
        'schedule',
        'recurring',
        'sent',
    ];

    protected $casts = [
        'send_date' => 'date',
        'create_date' => 'date',
        'due_date' => 'date',
        'is_schedule_sent' => 'boolean',
        'attach' => 'boolean',
        'is_scheduled' => 'boolean',
    ];

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type');
    }

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status');
    }

    public function paymentCurrency()
    {
        return $this->belongsTo(PaymentCurrency::class, 'payment_currency');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class, 'invoice_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function emails(){
        return $this->hasMany(InvoiceEmail::class, 'invoice_id');
    }
}
