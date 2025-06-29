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

    public function sampleTest()
    {
        return $this->belongsTo(SampleTests::class, 'code', 'code');
    }

    public function getValues(){
        return $this->hasMany(Sample_Test_Extra_Val::class, 'fieldid', 'id');
    }

}
