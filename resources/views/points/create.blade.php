<x-app-layout>
    <div class="container">
        <h1>新規ポイント作成</h1>
        <form action="{{ route('points.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">ポイント名</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">説明</label>
                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">画像</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">作成</button>
            <a href="{{ route('points.index') }}" class="btn btn-secondary">一覧に戻る</a>
        </form>
    </div>
</x-app-layout>
{{-- 注意: 画像のアップロード機能を使用するためには、ストレージ リンクを作成する必要があります。
{{-- コマンド: php artisan storage:link --}}
{{-- また、アップロードされた画像は、ストレージのpublicディレクトリに保存されることを想定しています。 --}}
{{-- そのため、ストレージの設定やパーミッションに注意してください。 --}}
{{-- 画像の保存先や表示方法は、プロジェクトの要件に応じて調整してください。 --}}