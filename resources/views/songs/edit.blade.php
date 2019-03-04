<?php $song = $song ?? new stdClass; ?>
@extends('layout')

@section('content')
<div class="main">
    <?php $url = ($isCreate ? '/songs' : '/songs/' . $song->id); ?>
    <form action="{{ $url }}" method="POST">
        {{ csrf_field() }}
        @if ($isCreate)
        @else
            <input type="hidden" name="_method" value="PUT">
        @endif

        <table>
            <tr>
                <th>名前</th>
                <td>
                    <input type="text" name="song[name]" value="{{ old('song.name', object_get($song, 'name')) }}">
                </td>
            </tr>
            <tr>
                <th>アルバム</th>
                <td>
                    <select name="song[album_id]">
                        <option value="" disabled selected>選択してください</option>
                        @foreach ($albums as $album)
                            <option
                                value="{{ $album->id }}"
                                @if (old('song.album_id', object_get($song, 'album_id')) == $album->id) selected @endif
                            >
                                {{ $album->name }}
                            </option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="送信">
                </td>
            </tr>
        </table>
    </form>
</div>
@endsection
