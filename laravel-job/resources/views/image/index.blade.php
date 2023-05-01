@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('Message'))
    <div class="alert alert-success">{{Session::get('Message')}}</div>
    @endif
        
    <h2 class="text-center">Зургийн цомог</h2>
    @if(Auth::check() && Auth::user()->user_type =='admin')
    <div class="text-end">
    <button class="btn btn-success  my-2">
    <a href="{{route('album.create')}}" class="text-white text-decoration-none ">+ Зургийн цомог үүсгэх</a>
</button>
</div>
    @endif
    <div class="row ">
        @foreach($albums as $album)
        <div class="col-sm-6 col-md-4">
            <div class="item w- 100">
                <a href="{{asset("album/$album->id")}}" class="w-100">
                    @if(empty($album->image))
                    <img src="{{asset('images/123.jpg')}}" alt="" class="img-thumbnail rounded-3 p-0 w-100" style="height:250px">
                   @else
                   <img src="{{asset('storage/'.$album->image)}}" alt="" class="img-thumbnail rounded p-0 w-100" style="height:250px">
                    @endif
      
                {{-- <a href="/album/{{$album->id}}" class="centered">{{$album->name}}</a> --}}
                </a>
                <!-- Button trigger modal -->
                @if(Auth::check() && Auth::user()->user_type =='admin')
                <div class="d-flex justify-content-between mb-4 my-2 align-items-center">
             <h3>{{$album->name}} </h3>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{$album->id}}">
    Зураг солих
  </button>
</div>
  
  <!-- Modal -->

  <div class="modal fade" id="exampleModal{{$album->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('album.add.image') }}" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Зургийн цомог өөрчлөх - {{$album->id}}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <input type="hidden"  name="id" class="form-control" value="{{$album->id}}">
            @csrf
            <div class="modal-body">
            <input type="file" name="image" class="form-control">
          
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Хаах</button>
              <button type="submit" class="btn btn-primary">Хадгалах</button>
            </div>
        </form>
      </div>
    </div>
  </div>
 
  @endif
            </div>
        </div>
        @endforeach
    </div>
</div>   


@endsection
<style></style>