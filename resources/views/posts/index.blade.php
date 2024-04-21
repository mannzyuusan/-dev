<x-app>
    <x-slot name="title">
    新生活応援ブログ
    </x-slot>
<x-navigation>
<x-slot name="navbar">
    </x-slot>
</x-navigation>
        <h2>投稿一覧画面</h2>
        <a href='/posts/create'>新規投稿</a>
        <div>
            @foreach ($posts as $post)
                <div style='border:solid 1px; margin-bottom: 10px;'>
                    <p>タイトル：<a href="/posts/{{ $post->id }}">{{ $post->title }}</a></p>
                    <p>カテゴリー：<a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a></p>
                    <p>住所：<a href="/posts/{{ $post->id }}">{{ $post->address }}</a></p>
                </div>
            @endforeach
        </div>
        <div>
            {{ $posts->links() }}
        </div>
        <a href='/posts/map'>マップはこちら</a>
        <a href="/posts/map2">近場検索はこちらから！</a>
    </body>
</html>

</x-app>

