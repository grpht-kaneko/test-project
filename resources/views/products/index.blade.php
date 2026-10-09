<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
</head>

<body>
    <h1>商品一覧</h1>

    <a href="{{ route('products.create') }}">新規登録</a>

    <table border="1" cellpadding="8">
        <tr>
            <th>商品名</th>
            <th>SKU</th>
            <th>単価</th>
            <th>在庫数</th>
            <th></th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->unit_price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    <a href="{{ route('products.edit', $product) }}">編集</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('削除しますか？')">削除</button>
                    </form>
                    {{-- method="POST" + @method('DELETE'): 編集フォームで使った仕組みと同じで、「見た目はPOSTだが実質DELETE」とLaravelに伝えます
                    onclick="return confirm('削除しますか？')": 削除は取り消せない操作なので、誤クリック防止のためブラウザ標準の確認ダイアログを出しています。confirm()がfalseを返す（キャンセルされる）と、フォームは送信されません
                    style="display:inline": <form>はデフォルトでブロック要素なので、見た目上「編集」リンクと並べるための簡易的な調整です（スタイリングは後で整えればOKです） --}}
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
