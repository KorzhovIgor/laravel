<?php

namespace App\Models;

use App\Enums\CurrencyEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Price extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'price',
        'product_id'
    ];

    protected $casts = [
        'currency' => CurrencyEnum::class
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}



//$this->builder->whereExists(function (Builder $query) use ($min_price) {
//    $query
//        ->select(DB::raw(1))
//        ->from('prices')
//        ->whereColumn('prices.product_id', '=', 'products.id')
//        ->where('price', '>=', 400)
//        ->where('prices.created_at', function ($subquery) {
//            $subquery
//                ->select(DB::raw('MAX(t1.created_at)'))
//                ->from('prices as t1')
//                ->whereColumn('t1.product_id', '=', 'products.id');
//        });
