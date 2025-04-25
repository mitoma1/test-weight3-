<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ログイン - PiGLy</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="min-h-screen">
        <div class="bg-white">
            <h1>PiGLy</h1>
            <p class="text-center">ログインしてください</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
                @error('email')
                <p class="text-red">{{ $message }}</p>
                @enderror

                <input type="password" name="password" placeholder="パスワード">
                @error('password')
                <p class="text-red">{{ $message }}</p>
                @enderror

                <button type="submit">ログイン</button>

                <p class="text-center mt-4">
                    <a href="{{ route('register.step1') }}">アカウント作成はこちら</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>