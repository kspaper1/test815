<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoiceId',
        'product_name',
        'date',
        'sales_person',
        'customer_name',
        'customer_id',
        'product_id',
        'employee_id',
        'city'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
