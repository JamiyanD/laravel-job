@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="errMsg"></div>
           <div class="show"></div>
           <button class="btn btn-success my-2"><a href="{{route('album.index')}}" class="text-decoration-none text-white " >Зургийн цомог үзэх</a></button>
            <form id="form" action="{{route('album.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Зургийн цомгийн нэр</label>
                <input type="text" name="album" class="form-control mb-2">
            </div>
         

               <div class="">
                <div class="input-group control-group initial-add-more">
                    <input type="file" name="image[]" class="form-control mb-2" id="image" >
                    <div class="input-group-btn">
                        <button class="btn btn-primary btn-add-more" type="button" >Нэмэх</button>
                    </div>
                   </div>
               </div>

               <div class="copy" style="display: none;">
                <div class="input-group control-group add-more">
                    <input type="file" name="image[]" class="form-control mb-2" id="image" >
                    <div class="input-group-btn">
                        <button class="btn btn-danger remove" type="button">Устгах</button>
                    </div>
                   </div>
               </div>
<br>
            <div class="form-group">
                <button class="btn btn-success"  >Хадгалах</button>
            </div>
            </form>
            
      {{-- <form action=" {{ route('album.store' )}} " method="POST" enctype="multipart/form-data">
        @csrf
   
        <input  type="text" name="album" class="form-control" placeholder="Zurgiin tsomgiin ner oruulna u"/>
        <input  type="file" name="image[]" class="form-control"/>
        <input  type="file" name="image[]" class="form-control"/>
        <button type="submit" class="btn btn-primary mt-2" >Хадгалах</button>
      </form>
      <br>
      <br>
      @foreach ($images as $image){
        <img src="{{asset('storage/'.$image->name)}}" class="img-thumbnail">
      }
          
      @endforeach --}}
    
            </div>
        </div>
    </div>
</div>   


@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // var album= $("#album").val();
    // if(album === ""){
    //     alert("Error");
    //     return
    // }

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
<script type="text/javascript">
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

</script>