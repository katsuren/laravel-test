@extends('layout')

@section('content')

<div class="main">
    <a href="/songs/create">新規作成</a>

    <form action="/songs" method="GET">
        <table>
            <thead>
                <tr>
                    <th colspan="2">検索</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>名前</td>
                    <td>
                        <input type="text" name="search[name]" value="{{ old('search.name') }}">
                    </td>
                </tr>
                <tr>
                    <td>アルバム名</td>
                    <td>
                        <input type="text" name="search[album:name]" value="{{ old('search.album:name') }}">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="検索">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

    <table>
        <thead>
            <th>ID</th>
            <th>名前</th>
            <th> - </th>
        </thead>
        <tbody>
            @foreach ($songs as $song)
                <td><a href="/songs/{{ $song->id }}">{{ $song->id }}</a></td>
                <td>{{ $song->name }}</td>
                <td>
                    <a href="/songs/{{ $song->id }}/edit"><button>編集</button></a><br>
                    <form action="/songs/{{ $song->id }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button>削除</button>
                    </form>
                </td>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
