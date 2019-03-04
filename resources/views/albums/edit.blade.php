<?php $album = $album ?? new stdClass; ?>
@extends('layout')

@section('content')
<div class="main">
    <?php $url = ($isCreate ? '/albums' : '/albums/' . $album->id); ?>
    <form action="{{ $url }}" method="POST">
        {{ csrf_field() }}
        @if ($isCreate)
        @else
            <input type="hidden" name="_method" value="PUT">
        @endif

        <table>
            <tr>
                <th>タイトル</th>
                <td>
                    <input type="text" name="album[name]" value="{{ old('album.name', object_get($album, 'name')) }}">
                </td>
            </tr>
            <tr>
                <th>アーティスト</th>
                <td>
                    <select name="album[artist_id]">
                        <option value="" disabled selected>選択してください</option>
                        @foreach ($artists as $artist)
                            <option
                                value="{{ $artist->id }}"
                                @if (old('album.artist_id', object_get($album, 'artist_id')) == $artist->id) selected @endif
                            >
                                {{ $artist->name }}
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
