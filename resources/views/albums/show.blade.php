@extends('layout')

@section('content')
<div class="main">
    <a href="/albums/{{ $album->id }}/edit">編集する</a>

    <table>
        <tr>
            <th>名前</th>
            <td>
                {{ $album->name }}
            </td>
        </tr>
    </table>

    <h2>アーティスト</h2>
    <table>
        <tr>
            <td>
                <a href="/artists/{{ $album->artist->id }}">{{ $album->artist->name }}</a>
            </td>
        </tr>
    </table>

    <h2>曲目</h2>
    <table>
        @foreach ($album->songs as $song)
            <tr>
                <td>
                    <a href="/songs/{{ $song->id }}">{{ $song->name }}</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
