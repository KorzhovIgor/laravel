<?php

namespace App\Filters;


use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ProductFilter extends QueryFilter
{
    /**
     * @param string $title
     * @return void
     */
    public function title(string $title): void
    {
        $this->builder->where('products.name', 'like', "{$title}%");
    }

    /**
     * @param string $producer
     * @return void
     */
    public function producer(string $producer): void
    {
        $this->builder->where('products.producer', $producer);
    }

    /**
     * @param string $min_price
     * @return void
     */
    public function min_price($min_price): void
    {
        $this->builder->whereExists(function (Builder $query) use ($min_price) {
            $query
                ->select(DB::raw(1))
                ->from('prices')
                ->whereColumn('prices.product_id', '=', 'products.id')
                ->where('price', '>=', 400)
                ->where('prices.created_at', function ($subquery) {
                    $subquery
                        ->select(DB::raw('MAX(t1.created_at)'))
                        ->from('prices', 't1')
                        ->whereColumn('t1.product_id', '=', 'products.id');
                });
        });
    }

    /**
     * @param string $max_price
     * @return void
     */
//    public function max_price(string $max_price): void
//    {
//        $this->builder->whereHas('prices', function (Builder $query) {
//
//            $query->where('prices.price', '<=',  $max_price)
                ->where('prices')
//;
//        });
//    }

   /* public function sort(string $sortType): void
    {
        $this->builder->orderBy(function (Builder $query) use ($sortType) {
            $query->orderBy('prices.price', $sortType);
        });
    }*/
}
