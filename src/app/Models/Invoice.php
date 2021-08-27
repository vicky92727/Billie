<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceItem;
use App\Models\Company;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'detail',
        'company_id',
        'status',
        'invoice_to',
        'invoice_number',
        'invoice_date',
        'invoice_due_date',
        'invoice_total',
    ];

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function company()
    {
      return $this->belongsTo(Company::class);
    }
}
