<?php $artist = $artist ?? new stdClass; ?>
@extends('layout')

@section('content')
<div class="main">
    <?php $url = ($isCreate ? '/artists' : '/artists/' . $artist->id); ?>
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
                    <input type="text" name="artist[name]" value="{{ old('artist.name', object_get($artist, 'name')) }}">
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
