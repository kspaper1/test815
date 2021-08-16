<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'full_name',
        'email',
        'gender',
        'street',
        'city'
    ];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
