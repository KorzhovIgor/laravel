<?php

namespace App\Filters;


use Illuminate\Database\Query\Builder;

class ProductFilter extends QueryFilter
{
    /**
     * @param string $title
     * @return void
     */
    public function title(string $title): void
    {
        $this->builder->where('products.name', 'like', "$title%");
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
    public function min_price(string $min_price): void
    {
        $this->builder->where(function (Builder $query) {
            $query
                ->select('price')
                ->from('prices')
                ->whereColumn('prices.product_id', '=', 'products.id')
                ->orderBy('created_at', 'desc')
                ->limit(1);
        }, '>=', $min_price);
    }

    /**
     * @param string $max_price
     * @return void
     */
    public function max_price(string $max_price): void
    {
        $this->builder->where(function (Builder $query) {
            $query
                ->select('price')
                ->from('prices')
                ->whereColumn('prices.product_id', '=', 'products.id')
                ->orderBy('created_at', 'desc')
                ->limit(1);
        }, '<=', $max_price);
    }

    /**
     * @param string $sort_type
     * @return void
     */
    public function sort(string $sort_type): void
    {
        $this->builder->orderBy(function (Builder $query) {
            $query
                ->select('price')
                ->from('prices')
                ->whereColumn('prices.product_id', '=', 'products.id')
                ->orderBy('created_at', 'desc')
                ->limit(1);
        }, $sort_type);
    }

}
