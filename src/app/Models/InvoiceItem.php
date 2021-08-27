<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class InvoiceItem extends Model
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
        'status',
        'invoice_number',
        'item_cost',
        'item_qty',
        'item_total',
    ];

    public function Invoice()
    {
      return $this->belongsTo(Invoice::class);
    }
}
