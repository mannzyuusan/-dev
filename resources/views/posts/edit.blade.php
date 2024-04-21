<x-navigation>
<x-slot name="navbar">
    </x-slot>
</x-navigation>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1 class="title">編集画面</h1>
        <div class="content">
            <form action="/posts/{{ $post->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class='content__title'>
                    <h4>タイトル</h4>
                    <input type='text' name='post[title]' value="{{ $post->title }}">
                </div>
                <div class='content__body'>
                    <h4>本文</h4>
                    <input type='text' name='post[body]' value="{{ $post->body }}">
                </div>
                 <h4>住所</h4>
                 <input type='text' name='post[title]' value="{{ $post->address }}">
                 <p></p>
                <input type="submit" value="保存">
                <p><a href="/posts">戻る</a></p>
            </form>
        </div>
    </body>
</html>
