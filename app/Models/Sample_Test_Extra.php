<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sample_Test_Extra extends Model
{
    //
    protected $table = 'sample_test_extras';

    protected $fillable = [
        'code',
        'fieldname',
        'fieldtype',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

}
