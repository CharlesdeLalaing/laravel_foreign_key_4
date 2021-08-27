@extends('layouts.base')

@section('content')
    <div class="container">
        <form action="/album/{{$edit->id}}/update" method="POST" class="container w-50" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Image</label>
                <input type="file" name="url" value={{$edit->url}} class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
