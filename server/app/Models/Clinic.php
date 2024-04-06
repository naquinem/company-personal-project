<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;
    protected $table = 'clinics';
    protected $fillable = [
        'clinic_name',
        'doctors_name',
        'serial_number',
        'clinic_code',
        'installation_date',
        'product',
        'address',
    ];
}
