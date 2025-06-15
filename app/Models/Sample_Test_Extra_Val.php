<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sample_Test_Extra_Val extends Model
{
    //
    protected $table = 'sample_test_extra_vals';

    protected $fillable = [
        'fieldid',
        'code',
        'fieldvalue',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

}
