<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    /**
     * @return BelongsToMany
     */
    public function products(): belongsToMany  {
        return $this->belongsToMany(Product::class, 'products_services')
            ->withPivot('price', 'term_days');
    }
}
