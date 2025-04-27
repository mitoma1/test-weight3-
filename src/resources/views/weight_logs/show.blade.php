<!-- resources/views/weight/show.blade.php -->

@extends('layouts.app')

@section('content')
<h1>体重ログ詳細</h1>

<p>日付: {{ $weightLog->date }}</p>
<p>体重: {{ $weightLog->weight }}</p>

<a href="{{ route('weight_logs.index') }}">戻る</a>
@endsection