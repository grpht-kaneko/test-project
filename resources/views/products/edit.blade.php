<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>商品編集</title>
</head>

<body>
    <h1>商品編集</h1>

    <form action="{{ route('products.update', $product) }}" method="POST">

        @if ($errors->any())
            <ul style="color:red">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @csrf
        @method('PUT')

        <label>商品名: <input type="text" name="name" value="{{ old('name', $product->name) }}"></label><br>
        <label>SKU: <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"></label><br>
        <label>単価: <input type="number" name="unit_price" value="{{ old('unit_price', $product->unit_price) }}"></label><br>
        <label>在庫数: <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}"></label><br>
        <label>発注点: <input type="number" name="reorder_point" value="{{ old('reorder_point', $product->reorder_point) }}"></label><br>
        {{-- route('products.update', $product): 名前付きルートに$productを渡すと、Laravelが自動的に/products/{id}のURLを組み立ててくれます（createのときはIDが不要でしたが、updateは「どのレコードを更新するか」を指定する必要があるため）
        @method('PUT'): HTMLの<form>タグは本来GETとPOSTしか送信できませんが、Laravelでは@method('PUT')という隠しフィールドを使って「このリクエストは実質PUTです」とLaravel側に伝える仕組みがあります。Route::resourceの更新用ルートはPUT（またはPATCH）で定義されているため、これが必要です
        value="{{ $product->name }}"のように、各入力欄にすでに登録されている値を初期値として埋め込んでいます --}}

        <button type="submit">更新</button>
    </form>
</body>

</html>
