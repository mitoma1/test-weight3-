<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>PiGLy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/weight_logs.css') }}">

    @yield('styles') <!-- 各ページごとの追加CSS -->
</head>

<body class="font-sans antialiased">
    @yield('content') <!-- ページのコンテンツを表示 -->
</body>

</html>