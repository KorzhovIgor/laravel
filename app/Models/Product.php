<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'producer', 'description', 'creation_date', 'price'];

    /**
     * @return BelongsToMany
     */
    public function services(): belongsToMany  {
        return $this->belongsToMany(Service::class, 'product_service');
    }
}
