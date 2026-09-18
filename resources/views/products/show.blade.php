<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品詳細</title>
</head>
<body>
    <h1>商品詳細</h1>

    <p>商品名: {{ $product->name }}</p>
    <p>SKU: {{ $product->sku }}</p>
    <p>単価: {{ $product->unit_price }}</p>
    <p>在庫数: {{ $product->quantity }}</p>
    <p>発注点: {{ $product->reorder_point }}</p>

    <a href="{{ route('products.edit', $product) }}">編集</a>
    <a href="{{ route('products.index') }}">一覧に戻る</a>
</body>
</html>
