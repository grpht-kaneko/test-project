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

        <button type="submit">更新</button>
    </form>
</body>

</html>
