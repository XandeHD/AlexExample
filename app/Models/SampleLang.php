<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SampleLang extends Model
{
    //

    public $incrementing = false;

    protected $table = 'sample_test_langs';

    protected $primaryKey = ['code', 'lang'];
    
    protected $fillable = [
            'code',
            'lang',
            'description',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at'
        ];

}
