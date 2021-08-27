@extends('layouts.base')

@section('content')
    <div class="container">
        <div>
            <button><a href="/album-create">créer nouvel album</a></button>
        </div>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Auteur</th>
                        <th scope="col">Url</th>
                        <th scope="col">Image</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($albums as $album)
                        <tr>
                            <th scope="row">{{$album->id}}</th>
                            <td>{{$album->nom}}</td>
                            <td>{{$album->auteur}}</td>
                            <td>{{$album->photos->url}}</td>
                            <td>
                                <img src={{asset('storage/img/'.$album->photos->url)}} alt="" height="100px">
                            </td>
                            <td>
                                <form action="/album/{{$album->id}}/delete" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger text-white">DELETE</button>
                                </form>
                            </td>
                            <td>
                                <a href="/album/{{$album->id}}/edit" class="btn btn-primary text-white">EDIT</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
