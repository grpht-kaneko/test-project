<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    // hasMany(Product::class): 「1つのカテゴリは複数の商品を持つ」というリレーションの定義。これで$category->productsと書くだけで、そのカテゴリに属する商品一覧を取得できるようになります
    // HasManyという戻り値の型は、Laravelのリレーションメソッドの決まり文句です
}
