<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::all();
        $photo = Photo::all();
        return view('welcome', compact('albums', 'photo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.album.createalbum');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            "url" => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048']
            ]);

            $request->file('url')->storePublicly('img/','public');

        $storePhoto = new Photo;
        $storePhoto->url = $request->file('url')->hashName();
        Storage::put('public/img', $request->file('url'));
        $storePhoto->save();

        $storeAlbum = new Album;
        $storeAlbum->nom = $request->nom;
        $storeAlbum->auteur = $request->auteur;
        $storeAlbum->photo_id = $storePhoto->id;
        $storeAlbum->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Photo::find($id);
        return view('pages.photo.editphoto', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            "url" => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048']
            ]);

            $request->file('url')->storePublicly('img/','public');

            $updatePhoto = Photo::find($id);

            Storage::delete('public/img'.$updatePhoto->url);
            $updatePhoto->url = $request->file('url')->hashName();
            Storage::put('public/img', $request->file('url'));
            $updatePhoto->save();



        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Album::find($id);
        $destroyPhoto = Photo::find($id);

        Storage::delete('public/storage/img/'.$destroyPhoto->url);
        Storage::delete('storage/app/public/img/'.$destroyPhoto->url);
        $destroy->delete();
        $destroyPhoto->delete();

        return redirect('/');
    }
}
