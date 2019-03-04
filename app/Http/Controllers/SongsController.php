<?php

namespace App\Http\Controllers;

use App\Eloquents\Album;
use App\Eloquents\Song;
use App\Http\Requests\SongRequest;

class SongsController extends Controller
{
    protected $albumEloquent;
    protected $songEloquent;

    public function __construct(
        Album $albumEloquent,
        Song $songEloquent
    ) {
        $this->albumEloquent = $albumEloquent;
        $this->songEloquent = $songEloquent;
    }

    public function index()
    {
        $songs = $this->songEloquent->pimp(request()->input('search', []))->get();
        return view('songs.index')->with([
            'songs' => $songs,
        ]);
    }

    public function show($id)
    {
        $song = $this->songEloquent->find($id);
        return view('songs.show')->with([
            'song' => $song,
        ]);
    }

    public function create()
    {
        $albums = $this->albumEloquent->get();
        return view('songs.edit')->with([
            'isCreate' => true,
            'albums' => $albums,
        ]);
    }

    public function store(SongRequest $request)
    {
        $song = $this->songEloquent->create($request->input('song'));
        return redirect('/songs/' . $song->id)->with('flash_message', '曲を作成しました');
    }

    public function edit($id)
    {
        $song = $this->songEloquent->find($id);
        $albums = $this->albumEloquent->get();
        return view('songs.edit')->with([
            'isCreate' => false,
            'song' => $song,
            'albums' => $albums,
        ]);
    }

    public function update(SongRequest $request, $id)
    {
        $song = $this->songEloquent->find($id);
        $song->fill($request->input('song'));
        $song->save();
        return redirect('/songs/' . $id)->with('flash_message', '曲を更新しました');
    }

    public function destroy($id)
    {
        $song = $this->songEloquent->find($id);
        $song->delete();
        return redirect('/songs')->with('flash_message', '曲を削除しました');
    }
}
