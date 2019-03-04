<?php

namespace App\Http\Controllers;

use App\Eloquents\Artist;
use App\Http\Requests\ArtistRequest;

class ArtistsController extends Controller
{
    protected $artistEloquent;

    public function __construct(Artist $artistEloquent)
    {
        $this->artistEloquent = $artistEloquent;
    }

    public function index()
    {
        $artists = $this->artistEloquent->pimp(request()->input('search', []))->get();
        return view('artists.index')->with([
            'artists' => $artists,
        ]);
    }

    public function show($id)
    {
        $artist = $this->artistEloquent->find($id);
        return view('artists.show')->with([
            'artist' => $artist,
        ]);
    }

    public function create()
    {
        return view('artists.edit')->with([
            'isCreate' => true,
        ]);
    }

    public function store(ArtistRequest $request)
    {
        $artist = $this->artistEloquent->create($request->input('artist'));
        return redirect('/artists/' . $artist->id)->with('flash_message', 'アーティストを作成しました');
    }

    public function edit($id)
    {
        $artist = $this->artistEloquent->find($id);
        return view('artists.edit')->with([
            'isCreate' => false,
            'artist' => $artist,
        ]);
    }

    public function update(ArtistRequest $request, $id)
    {
        $artist = $this->artistEloquent->find($id);
        $artist->fill($request->input('artist'));
        $artist->save();
        return redirect('/artists/' . $id)->with('flash_message', 'アーティストを更新しました');
    }

    public function destroy($id)
    {
        $artist = $this->artistEloquent->find($id);
        $artist->delete();
        return redirect('/artists')->with('flash_message', 'アーティストを削除しました');
    }
}
