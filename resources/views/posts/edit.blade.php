<x-app>
    <x-slot name="title">
    編集
    </x-slot>
<x-navigation>
<x-slot name="navbar">
    </x-slot>
</x-navigation>
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
                 <input type='text' name='post[address]' value="{{ $post->address }}">
                 <h4>カテゴリー</h4>
                <select name="post[category_id]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                 <p></p>
                <input type="submit" value="保存">
                <p><a href="/posts">戻る</a></p>
            </form>
        </div>
    </body>
</html>
</x-app>