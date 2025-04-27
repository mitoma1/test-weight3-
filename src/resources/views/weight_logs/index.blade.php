@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">

    <!-- ヘッダー -->
    <div class="header">
        <div class="flex justify-between items-center mb-4">

            <div class="logo">PiGLy</div>

            <!-- ログアウトボタン（右端に配置） -->
            <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                @csrf
                <button type="submit" class="header-button">ログアウト</button>
            </form>

            <div class="flex items-center space-x-4">
                <!-- 目標体重設定ボタン -->
                <a href="{{ route('weight_logs.goal_setting') }}" class="header-button">目標体重設定</a>

                <!-- 目標体重・最新体重・目標まで -->
                <div class="grid grid-cols-3 gap-4 mb-8">
                    <div class="card">
                        <div class="text-gray-500">目標体重</div>
                        <div class="text-2xl font-bold">{{ $targetWeight ?? '45.0' }} kg</div>
                    </div>
                    <div class="card">
                        <div class="text-gray-500">目標まで</div>
                        <div class="text-2xl font-bold">{{ $targetDifference ?? '-1.5' }} kg</div>
                    </div>
                    <div class="card">
                        <div class="text-gray-500">最新体重</div
                            <div class="text-2xl font-bold">{{ $latestWeight ?? '46.5' }} kg
                    </div>
                </div>
            </div>

            <!-- 検索フォーム -->
            <form method="GET" action="{{ route('weight_logs.search') }}" class="flex items-center mb-4 space-x-2">
                <input type="date" name="start_date" class="border p-2 rounded" />
                <span>〜</span>
                <input type="date" name="end_date" class="border p-2 rounded" />
                <button type="submit" class="header-button">検索</button>
            </form>

            <!-- データ追加ボタン -->
            <a href="{{ route('weight_logs.create') }}" class="gradient-button">データ追加</a>
        </div>
    </div>
</div>

<!-- 体重データ表 -->
<div class="table-container mb-8">
    <table>
        <thead>
            <tr>
                <th>日付</th>
                <th>体重</th>
                <th>食事摂取カロリー</th>
                <th>運動時間</th>
                <th>編集</th>
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
                    <a href="{{ route('weight_logs.update', $log->id) }}">✏️</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- ページネーション -->
<div class="pagination flex justify-center">
    <!-- 前ページ -->
    @if ($logs->onFirstPage())
    <span class="active">
        <span>前へ</span>
    </span>
    @else
    <a href="{{ $logs->previousPageUrl() }}" class="page-link">前へ</a>
    @endif

    <!-- ページリンク -->
    @for ($i = 1; $i <= $logs->lastPage(); $i++)
        <a href="{{ $logs->url($i) }}" class="page-link {{ $i == $logs->currentPage() ? 'active' : '' }}">
            <span>{{ $i }}</span>
        </a>
        @endfor

        <!-- 次ページ -->
        @if ($logs->hasMorePages())
        <a href="{{ $logs->nextPageUrl() }}" class="page-link">次へ</a>
        @else
        <span class="active">
            <span>次へ</span>
        </span>
        @endif
</div>

</div>
@endsection