@extends('layouts.app')

@section('content')
<div class="w-full p-4">
    <!-- ヘッダー -->
    <div class="header flex justify-between items-center mb-4">
        <div class="logo text-2xl font-bold">PiGLy</div>
        <!-- ボタンを横並びに配置 -->
        <div class="flex items-center space-x-4 ml-auto">
            <!-- 目標体重設定ボタン -->
            <a href="{{ route('weight_logs.goal_setting') }}">
                <button type="button" class="py-2 px-6 bg-green-500 text-white rounded-md hover:bg-green-600 mb-6">
                    目標体重設定
                </button>
            </a>

            <!-- ログアウトボタン -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    ログアウト
                </button>
            </form>
        </div>
    </div>

    <!-- 目標体重・最新体重・目標まで -->
    <div class="flex justify-center items-center gap-6 mb-8">
        <div class="card p-4 border rounded-lg w-64 text-center">
            <div class="text-gray-500">目標体重</div>
            <div class="text-2xl font-bold">{{ $targetWeight ?? '45.0' }} kg</div>
        </div>
        <div class="card p-4 border rounded-lg w-64 text-center">
            <div class="text-gray-500">目標まで</div>
            <div class="text-2xl font-bold">{{ $targetDifference ?? '-1.5' }} kg</div>
        </div>
        <div class="card p-4 border rounded-lg w-64 text-center">
            <div class="text-gray-500">最新体重</div>
            <div class="text-2xl font-bold">{{ $latestWeight ?? '46.5' }} kg</div>
        </div>
    </div>
    <!-- 検索フォーム -->
    <form method="GET" action="{{ route('weight_logs.search') }}" class="flex items-center mb-4 space-x-2">
        <input type="date" name="start_date" class="border p-2 rounded" />
        <span class="mx-2">〜</span>
        <input type="date" name="end_date" class="border p-2 rounded" />
        <button type="submit" class="header-button py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600">
            検索
        </button>
        <button type="button" id="resetButton" class="py-2 px-4 bg-blue-500 text-white rounded-md hover:bg-blue-600">
            リセット
        </button>
    </form>

    <!-- データ追加ボタン -->
    <a href="{{ route('weight_logs.create') }}" class="inline-block mb-6 text-center">
        <button type="button" class="w-full add-data-button">
            データ追加
        </button>
    </a>

    <!-- 体重データ表 -->
    <div class="table-container mb-8">
        <table class="table w-full table-auto border-separate border-spacing-0">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">日付</th>
                    <th class="px-4 py-2 border">体重</th>
                    <th class="px-4 py-2 border">食事摂取カロリー</th>
                    <th class="px-4 py-2 border">運動時間</th>
                    <th class="px-4 py-2 border">編集</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                    <td>{{ $log->weight }} kg</td>
                    <td>{{ $log->calories }} cal</td>
                    <td>{{ $log->exercise_time }} 分</td>
                    <td>
                        <!-- えんぴつボタン（編集リンク） -->
                        <a href="{{ route('weight_logs.edit', $log->id) }}">✏️</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- ページネーション -->
    <div class="pagination flex justify-center space-x-2">
        <!-- 前ページ -->
        @if ($logs->onFirstPage())
        <span class="text-gray-500">前へ</span>
        @else
        <a href="{{ $logs->previousPageUrl() }}" class="page-link py-2 px-4 border rounded-md bg-gray-100 hover:bg-gray-200">前へ</a>
        @endif

        <!-- ページリンク -->
        @for ($i = 1; $i <= $logs->lastPage(); $i++)
            <a href="{{ $logs->url($i) }}" class="page-link py-2 px-4 border rounded-md {{ $i == $logs->currentPage() ? 'bg-blue-500 text-white' : 'bg-gray-100' }} hover:bg-gray-200">
                <span>{{ $i }}</span>
            </a>
            @endfor

            <!-- 次ページ -->
            @if ($logs->hasMorePages())
            <a href="{{ $logs->nextPageUrl() }}" class="page-link py-2 px-4 border rounded-md bg-gray-100 hover:bg-gray-200">次へ</a>
            @else
            <span class="text-gray-500">次へ</span>
            @endif
    </div>
</div>
<script>
    document.getElementById('resetButton').addEventListener('click', function() {
        document.querySelector('input[name="start_date"]').value = '';
        document.querySelector('input[name="end_date"]').value = '';
    });
</script>
@endsection