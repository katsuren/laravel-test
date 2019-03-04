@extends('layout')

@section('content')

<div class="main">
    <a href="/artists/create">新規作成</a>

    <form action="/artists" method="GET">
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
                        <input type="text" name="search[name]" value="{{ request('search.name') }}">
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
            @foreach ($artists as $artist)
                <td><a href="/artists/{{ $artist->id }}">{{ $artist->id }}</a></td>
                <td>{{ $artist->name }}</td>
                <td>
                    <a href="/artists/{{ $artist->id }}/edit"><button>編集</button></a><br>
                    <form action="/artists/{{ $artist->id }}" method="POST">
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
