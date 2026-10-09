<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku',
            'unit_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'reorder_point' => 'required|integer|min:0',
        ]);
        //$request->validate([...]): 送信データをルールに沿ってチェックします。ルールに違反していると、自動的に元のフォーム画面にリダイレクトされ、エラーメッセージがセッションに格納されます（今の段階ではまだ画面にエラー表示は出ませんが、後で対応します）
        //required: 必須項目
        //string / numeric / integer: 型のチェック
        //max:255: 最大文字数
        //min:0: 最小値
        //unique:products,sku: productsテーブルのskuカラム内で重複していないかチェック（在庫商品コードの重複を防ぐため）
        //バリデーションを通過すると、$validatedにはチェック済みの安全なデータだけが入っています
        //Product::create($validated): これが実際にINSERT文を発行する部分。$fillableに指定したカラムなので、まとめて書き込めます
        //redirect()->route('products.index'): 保存後、一覧ページへ転送

        Product::create($validated);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }
    //Route::resourceで定義された/products/{product}/editというURLの{product}部分（例: /products/3/editの3）を、Laravelが自動的に「ProductモデルのIDが3のレコードを検索する処理」に変換してくれます
    //つまり自分でProduct::find($id)やProduct::findOrFail($id)を書かなくても、引数の型をProductにしておくだけで、該当するレコードが見つかった状態の$productが渡ってきます
    //該当IDのレコードが存在しない場合は、Laravelが自動的に404エラーページを返してくれます（エラー処理も書かなくて済みます）

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku,' . $product->id,
            'unit_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'reorder_point' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('products.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
