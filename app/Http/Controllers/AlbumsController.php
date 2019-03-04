<?php

namespace App\Http\Controllers;

use App\Eloquents\Album;
use App\Eloquents\Artist;
use App\Http\Requests\AlbumRequest;

class AlbumsController extends Controller
{
    protected $albumEloquent;
    protected $artistEloquent;

    public function __construct(
        Album $albumEloquent,
        Artist $artistEloquent
    ) {
        $this->albumEloquent = $albumEloquent;
        $this->artistEloquent = $artistEloquent;
    }

    public function index()
    {
        $albums = $this->albumEloquent->pimp(request()->input('search', []))->get();
        return view('albums.index')->with([
            'albums' => $albums,
        ]);
    }

    public function show($id)
    {
        $album = $this->albumEloquent->find($id);
        return view('albums.show')->with([
            'album' => $album,
        ]);
    }

    public function create()
    {
        $artists = $this->artistEloquent->get();
        return view('albums.edit')->with([
            'isCreate' => true,
            'artists' => $artists,
        ]);
    }

    public function store(AlbumRequest $request)
    {
        $album = $this->albumEloquent->create($request->input('album'));
        return redirect('/albums/' . $album->id)->with('flash_message', 'アルバムを作成しました');
    }

    public function edit($id)
    {
        $album = $this->albumEloquent->find($id);
        $artists = $this->artistEloquent->get();
        return view('albums.edit')->with([
            'isCreate' => false,
            'album' => $album,
            'artists' => $artists,
        ]);
    }

    public function update(AlbumRequest $request, $id)
    {
        $album = $this->albumEloquent->find($id);
        $album->fill($request->input('album'));
        $album->save();
        return redirect('/albums/' . $id)->with('flash_message', 'アルバムを更新しました');
    }

    public function destroy($id)
    {
        $album = $this->albumEloquent->find($id);
        $album->delete();
        return redirect('/albums')->with('flash_message', 'アルバムを削除しました');
    }
}
