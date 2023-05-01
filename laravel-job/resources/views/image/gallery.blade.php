@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">{{$albums->name}} : {{$albums->images->count()}}ш зураг</h1>
@include('/image.addImageAlbum')
   

    <div class="row ">
        @foreach($albums->images as $album)
        <div class="col-sm-6 col-md-4">
            <div class="item w-100">
                <img src="{{asset('storage/'.$album->name)}}" alt="" 
                class="img-thumbnail rounded-3 p-0 w-100 " style="height: 250px">
                @if(Auth::check() && Auth::user()->user_type =='admin')
            <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#exampleModal2{{$album->id}}">
            Устгах
            </button>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal2{{$album->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Зургийг устгах</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
       Та энэхүү зургийг үнэхээр устгахыг хүсч байна уу?
        </div>
        <div class="modal-footer">
            <form action="{{route('album.destroy', [$album->id])}}" method="post">
                @csrf
                <button class="btn btn-danger" type="submit">Устгах</button>
               </form>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Хаах</button>
        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>


       $(document).ready(function() {
        $(".btn-add-more").click(function() {
          var html = $(".copy").html();
            $(".initial-add-more").after(html)
        });

        $("body").on("click", ".remove", function(){
            $(this).parents(".control-group").remove();
        })
    });
</script>
{{-- <script type="text/javascript">
$(document).ready(function(e){
    $("#form").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: "/album/create", 
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            success: function(response){
                $(".show").html(response);
                $("#form")[0].reset();
                $("#errMsg").empty();
            },
            error: function(data){
                
                var error = data.responseJSON;
                $("#errMsg").empty();
                $.each(error.errors, function(key, value){
                    $("#errMsg").append('<p class="text-center text-danger">' + value + '</p>')
                })
                // console.log(res.responseJSON);
                // alert("Aldaa garlaa, Zurgiig servert bairshuulj chadsangui.")
            }
        })
    })
})

</script> --}}

