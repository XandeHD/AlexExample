<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Session;

class SampleTests extends Model
{
    use HasFactory;

    protected $table = 'sample_tests';

    protected $primaryKey = 'id';

    protected $fillable = [
            'code',
            'description',
            'cost',
            'status',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at'
        ];

    public function descriptionByLocale()
    {
        return $this->hasOne(SampleLang::class, 'code', 'code')->where('lang', Session::get('locale'));
    }

    public function getLocalizedDescriptionAttribute(): string
    {
        $desc = $this->descriptionByLocale()->first()?->description;

        return $desc ?: $this->description;
    }
        
}

