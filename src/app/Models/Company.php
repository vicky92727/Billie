<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class Company extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'email',
        'phone',
        'address',
        'type',
        'debtor_limit',
    ];

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

}
