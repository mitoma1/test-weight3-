<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>体重記録 - 新規登録</title>
    <!-- CSSのリンク -->
    <link rel="stylesheet" href="{{ asset('css/create.blade.css') }}">
</head>

<body>
    <div class="container">
        <h1>体重記録 新規登録</h1>

        <!-- エラーメッセージ表示 -->
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <!-- フォーム -->
        <form action="{{ route('weight_logs.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="date">日付</label>
                <input type="date" id="date" name="date" class="form-control" value="{{ old('date') }}" required>
                @error('date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="weight">体重</label>
                <input type="text" id="weight" name="weight" class="form-control" value="{{ old('weight') }}" required>
                @error('weight')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="calories">摂取カロリー (kcal)</label>
                <input type="number" id="calories" name="calories" class="form-control" value="{{ old('calories') }}">
                @error('calories')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="exercise_time">運動時間 (分)</label>
                <input type="number" id="exercise_time" name="exercise_time" class="form-control" value="{{ old('exercise_time') }}">
                @error('exercise_time')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="notes">運動内容</label>
                <textarea id="notes" name="notes" class="form-control">{{ old('notes') }}</textarea>
                @error('notes')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">登録</button>
                <a href="{{ route('weight_logs.index') }}">
                    <button type="button" class="btn btn-secondary">戻る</button>
                </a>
            </div>
        </form>
    </div>
</body>

</html>