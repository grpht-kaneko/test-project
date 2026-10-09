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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('id')->constrained();
            // foreignId('category_id'): categoriesテーブルのidと同じ型（符号なしbigint）のcategory_idカラムを作る、外部キー用の書き方
            // ->nullable(): NULLを許可します。すでにproductsテーブルにはカテゴリ未設定のデータが入っているため、NOT NULLにすると既存データがエラーになってしまうためです
            // ->after('id'): idカラムの直後にこのカラムを配置する（見た目上の並び順の指定。PostgreSQLでは省略しても動作します）
            // ->constrained(): これが外部キー制約です。「category_idの値は、必ずcategoriesテーブルのidに存在する値でなければならない」というルールをDBレベルで強制します。存在しないカテゴリIDを指定しようとするとエラーになります
            // down()側は逆再生用に、まず外部キー制約を外し(dropForeign)、それからカラム自体を削除(dropColumn)しています
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
