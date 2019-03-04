@extends('layout')

@section('content')

<div class="main">
    <a href="/albums/create">新規作成</a>

    <form action="/albums" method="GET">
        <table>
            <thead>
                <tr>
                    <th colspan="2">検索</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>タイトル</td>
                    <td>
                        <input type="text" name="search[name]" value="{{ old('search.name') }}">
                    </td>
                </tr>
                <tr>
                    <td>アーティスト名</td>
                    <td>
                        <input type="text" name="search[artist:name]" value="{{ old('search.artist:name') }}">
                    </td>
                </tr>
                <tr>
                    <td rowspan="2">
                        <input type="submit" value="検索">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

    <table>
        <thead>
            <th>ID</th>
            <th>タイトル</th>
            <th>アーティスト名</th>
            <th> - </th>
        </thead>
        <tbody>
            @foreach ($albums as $album)
                <tr>
                    <td><a href="/albums/{{ $album->id }}">{{ $album->id }}</a></td>
                    <td>{{ $album->name }}</td>
                    <td>{{ $album->artist->name }}</td>
                    <td>
                        <a href="/albums/{{ $album->id }}/edit"><button>編集</button></a><br>
                        <form action="/albums/{{ $album->id }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button>削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
