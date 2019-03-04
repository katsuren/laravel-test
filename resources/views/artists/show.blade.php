@extends('layout')

@section('content')
<div class="main">
    <a href="/artists/{{ $artist->id }}/edit">編集する</a>

    <table>
        <tr>
            <th>名前</th>
            <td>
                {{ $artist->name }}
            </td>
        </tr>
    </table>

    <h2>アルバム</h2>
    <table>
        @foreach ($artist->albums as $album)
            <tr>
                <td>
                    <a href="/albums/{{ $album->id }}">{{ $album->name }}</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
