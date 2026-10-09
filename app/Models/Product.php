<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'unit_price',
        'quantity',
        'reorder_point',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    // $fillableに'category_id'を追加: これがないと、フォームからcategory_idを送ってもProduct::create()やupdate()で書き込まれません（マスアサインメント保護のため）
    // belongsTo(Category::class): hasManyの逆方向のリレーション。「1つの商品は1つのカテゴリに属する」という定義です。これで$product->categoryと書くだけで、そのカテゴリのレコードを取得できます
}
