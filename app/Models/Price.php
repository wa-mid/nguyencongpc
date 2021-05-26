<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
use Session;
use Cache;
use Helper;

class Price
{
    public static function getPriceList() {
        return collect([
            ['name' => '< 1 triệu', 'min' => 0,'max' => 1e6, 'slug' => '1-trieu'],
            ['name' => '1 - 2 triệu', 'min' => 1e6,'max' => 2e6, 'slug' => '1-2-trieu'],
            ['name' => '2 - 3 triệu', 'min' => 2e6,'max' => 3e6, 'slug' => '2-3-trieu'],
            ['name' => '3 - 5 triệu', 'min' => 3e6,'max' => 5e6, 'slug' => '3-5-trieu'],
            ['name' => '5 - 7 triệu', 'min' => 5e6,'max' => 7e6, 'slug' => '5-7-trieu'],
            ['name' => '7 - 9 triệu', 'min' => 7e6,'max' => 9e6, 'slug' => '7-9-trieu'],
            ['name' => '9 - 11 triệu', 'min' => 9e6,'max' => 11e6, 'slug' => '9-11-trieu'],
            ['name' => '11 - 15 triệu', 'min' => 11e6,'max' => 15e6, 'slug' => '11-15-trieu'],
            ['name' => '15 - 20 triệu', 'min' => 15e6,'max' => 20e6, 'slug' => '15-20-trieu'],
            ['name' => '20 - 30 triệu', 'min' => 20e6,'max' => 30e6, 'slug' => '20-30-trieu'],
            ['name' => '30 - 50 triệu', 'min' => 30e6,'max' => 50e6, 'slug' => '30-50-trieu'],
            ['name' => '50 - 70 triệu', 'min' => 50e6,'max' => 70e6, 'slug' => '50-70-trieu'],
            ['name' => '70 - 100 triệu', 'min' => 70e6,'max' => 10e6, 'slug' => '70-100-trieu'],
            ['name' => '>100 triệu', 'min' => 100e6,'max' => 1000e6, 'slug' => '100-trieu'],
        ]);
    }
    public static function getPriceFilter($priceIds) {
        $priceList = self::getPriceList();
        return $priceList->whereIn('slug', $priceIds)->all();
    }
	public static function getPriceListFilter($priceIds) {
        $priceList = self::getPriceList();
        return !empty($priceIds) ? $priceList->whereIn('slug', $priceIds)->all() : $priceList;
    }
    public static function addPriceFilter($result, $priceIds) {
        $priceList = self::getPriceFilter($priceIds);
        if($priceList) {
            $result->where(function ($query) use ($priceList) {
                foreach($priceList as $price) {
                    $query->orWhereRaw('IFNULL(price, regular_price) BETWEEN ? AND ?', [$price['min'], $price['max']]);
                }
            });
        }
        return $result;
    }

}
