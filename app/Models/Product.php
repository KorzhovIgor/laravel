<?php

namespace App\Models;

use App\Enums\ProducerEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'producer',
        'description'
    ];

    protected $casts = [
        'producer' => ProducerEnum::class
    ];

    /**
     * @return BelongsToMany
     */
    public function services(): belongsToMany
    {
        return $this->belongsToMany(Service::class, 'products_services')
            ->withPivot('price', 'term_days');
    }

    /**
     * @return HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(Price::class)->latest();
    }

    /**
     * @return HasOne
     */
    public function image(): HasOne
    {
        return $this->hasOne(Image::class);
    }
}
