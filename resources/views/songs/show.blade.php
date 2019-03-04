@extends('layout')

@section('content')
<div class="main">
    <a href="/songs/{{ $song->id }}/edit">編集する</a>

    <table>
        <tr>
            <th>名前</th>
            <td>
                {{ $song->name }}
            </td>
        </tr>
    </table>

    <h2>アルバム</h2>
    <table>
        <tr>
            <td>
                <a href="/albums/{{ $song->album->id }}">{{ $song->album->name }}</a>
            </td>
        </tr>
    </table>

    <h2>アーティスト名</h2>
    <table>
        <tr>
            <td>
                <a href="/artists/{{ $song->album->artist->id }}">{{ $song->album->artist->name }}</a>
            </td>
        </tr>
    </table>
</div>
@endsection
