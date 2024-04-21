<x-app>
    <x-slot name="title">
    カテゴリー
    </x-slot>
<x-navigation>
<x-slot name="navbar">
    </x-slot>
</x-navigation>
<body>
    <body>
   <h1>新生活応援ブログ</h1>
        <h2>カテゴリー:{{ $category_name }} の投稿一覧画面</h2>

        <a href='/posts'>投稿一覧ページへ戻る</a>
        <div>
            @foreach ($posts as $post)
                <div style='border:solid 1px; margin-bottom: 10px;'>
                    <p>
                        タイトル：<a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </p>
                    <p>カテゴリー：<a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a></p>
                </div>
            @endforeach
        </div>
        <div>
            {{ $posts->links() }}
        </div>
    </body>
</html>
</x-app>