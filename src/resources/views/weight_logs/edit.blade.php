@extends('layouts.app')

@section('content')
<div class="container">
    <h2>体重ログの編集</h2>

    <form action="{{ route('weight_logs.update', $log->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="date">日付</label>
            <input type="date" id="date" name="date" class="form-control" value="{{ old('date', $log->date) }}" required>
            @error('date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="weight">体重 (kg)</label>
            <input type="number" step="0.1" id="weight" name="weight" class="form-control" value="{{ old('weight', $log->weight) }}" required>
            @error('weight')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="calories">摂取カロリー</label>
            <input type="number" id="calories" name="calories" class="form-control" value="{{ old('calories', $log->calories) }}">
            @error('calories')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="exercise_time">運動時間 (分)</label>
            <input type="number" id="exercise_time" name="exercise_time" class="form-control" value="{{ old('exercise_time', $log->exercise_time) }}">
            @error('exercise_time')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="exercise_description">運動内容</label>
            <textarea id="exercise_description" name="exercise_description" class="form-control" rows="3">{{ old('exercise_description', $log->exercise_description) }}</textarea>
            @error('exercise_description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection