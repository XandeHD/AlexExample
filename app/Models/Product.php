<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    protected $fillable = [
        'code',
        'category',
        'type',
        'description',
        'brand',
        'model',
        'serial_number',
        'width',
        'length',
        'volume',
        'weight',
        'density',
        'material',
        'color',
        'expiration_date',
        'batch',
        'is_hazardous',
        'storage_temp',
        'ph',
        'concentration',
        'concentration_unit',
        'barcode',
    ];


    
}
