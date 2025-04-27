<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>目標体重の設定</title>
    <link rel="stylesheet" href="{{ asset('css/goal_setting.css') }}">
</head>

<body>
    <div>
        <h1>目標体重の設定</h1>

        <form method="POST" action="{{ route('weight_logs.goal_setting') }}">
            @csrf
            <div>
                <label for="goal_weight">目標体重 (kg)</label>
                <input type="text" name="goal_weight" id="goal_weight" value="{{ old('goal_weight', $currentGoalWeight) }}">

                @error('goal_weight')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit">更新</button>
                <a href="{{ route('weight_logs.index') }}">戻る</a>
            </div>
        </form>
    </div>
</body>

</html>