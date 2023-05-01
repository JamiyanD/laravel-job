

@if(Auth::check() && Auth::user()->user_type =='admin')
<div class="d-flex justify-content-between">
    <button class="btn btn-success my-2"><a href="{{route('album.index')}}" class="text-decoration-none text-white " >Зургийн цомог үзэх</a></button>
<button type="button" class="btn btn-success  my-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
    + Зураг нэмэх
      </button>
    </div>
      @endif
      
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form" action="{{route('album.image')}}" method="post" enctype="multipart/form-data">
                @csrf
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Шинэ зураг нэмэх</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
             
                    <div class="form-group">
                        <input type="hidden"  name="id" class="form-control" value="{{$albums->id}}">
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
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Хаах</button>
              <button type="submit"  class="btn btn-success">Хадгалах</button>
            </div>
      
          </div>
        </form>
        </div>
      </div>