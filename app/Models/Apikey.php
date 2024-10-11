<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apikey extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = ['company_id', 'key', 'is_active'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
