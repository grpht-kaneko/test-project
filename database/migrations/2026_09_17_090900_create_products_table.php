<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku')->unique();
            $table->decimal('unit_price', 10, 2);
            $table->unsignedInteger('quantity')->default(0);
            $table->unsignedInteger('reorder_point')->default(0);
            $table->timestamps();
            //string('name'): 商品名（可変長文字列）
            //string('sku')->unique(): 商品コード。unique()で重複を許可しない制約をつけています
            //decimal('unit_price', 10, 2): 単価。小数点以下2桁まで扱える金額用の型
            //unsignedInteger('quantity')->default(0): 在庫数。マイナスにならない整数、初期値0
            //unsignedInteger('reorder_point')->default(0): 発注点（この数を下回ったら在庫僅少とみなす基準値）
        });
        //Schema::create('products', ...): productsテーブルを作る宣言
        //$table->id(): 主キーidカラム（自動採番）
        //$table->timestamps(): created_atとupdated_atを自動で持たせるおまじない
        //down()側はロールバック（元に戻す）時の処理で、テーブルを削除する内容が自動で入っています
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
