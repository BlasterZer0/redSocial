<!-- tweetbox starts -->
<div class="tweetBox">
  <form action="{{ route('comment.store') }}" method="POST">
    @csrf
    <div class="container p-2">
      <div class="row">
        <div class="col-sm-auto">
          <img class="postImg" src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt=""/>
        </div>
        
        <div class="col">
        
          <input class="invisible" type="text" name="id" value="{{ $tweet->id }}" readonly style="display: none"/>
          <textarea class="tweetBox_textarea" name="reply" placeholder="Tweet your reply" maxlength="255"></textarea>
          <img id="showImgR" class="tweetImg img-fluid mx-auto d-block" accept=".png, .jpg, .jpeg"/>
          
          <div class="row">
            <div class="col">
              <div class="d-flex justify-content-between align-items-center">
                <div class="image-upload p-2">
                  <label for="imgInpR">
                    <span class="material-icons icon"> add_a_photo </span>
                  </label>
                  <input class="fileR" id="imgInpR" name="image" type="file" />
                  <span class="material-icons icon" onclick="deleteImgR()">hide_image</span>
                </div>
                        <script>                     
                          imgInpR.onchange = evt => {
                            const [file] = imgInpR.files
                            if (file) {
                              showImgR.src = URL.createObjectURL(file)
                            }
                          }
                          function deleteImgR() {
                      document.getElementById("showImgR").removeAttribute("src"); 
                      const file = document.querySelector('.fileR');
                      var emptyFile = document.createElement('input');
                      emptyFile.type = 'file';
                      file.files = emptyFile.files;
                    }
                        </script>
                <div class="p-2">
                   <button class="tweetBox__tweetButton">Reply</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- tweetbox ends -->

<!-- comment starts -->
@forelse ($tweet->comments as $reply)
  <div class="post px-3 mt-1">
    <div class="post__avatar">
      <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt=""/>
    </div>
    
    <div class="post__body">
      <div class="post__header">
        <div class="post__headerText">
          <div class="row">
            <div class="col-sm-auto d-flex align-items-center">
              <span class="fw-bold fs-6 account">{{ $reply->user->name }}</span>
              <span class="material-icons post__badge"> verified </span>
              <span class="post__headerSpecial account">
                {{ $reply->user->account . " · " . $reply->created_at->format('H:i - D j, o')}}
              </span>
            </div>
            
            <div class="col d-flex justify-content-end dropstart">
              <span class="material-icons icon" data-bs-toggle="dropdown" aria-expanded="false"> more_horiz </span>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item d-flex align-items-center text-danger">
                    <span class="material-icons"> delete_forever </span>
                     <form action="{{ route('comment.destroy', $reply) }}" method="post">
                      @method('DELETE')
                      @csrf
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Delete Reply?')">Delete</button>
                    </form>
                  </a>
                </li>
                <li>
                  <a id="{{ $reply }}" class="dropdown-item d-flex align-items-center text-warning" data-bs-toggle="modal" data-bs-target="#editReplyModal{{$reply->id}}">
                    <span class="material-icons"> drive_file_rename_outline </span>
                    Edit tweet
                  </a>
                </li>
              </ul>                  
            </div>

          </div>     
          <div class="row">
            <div class="col d-flex align-items-center">
              <span class="post__headerSpecial">
                Replying to <span class="text-primary account">{{ $tweet->user->account }}</span>
              </span>
            </div>
          </div>         
        </div>
        
        <div class="post__headerDescription">
          {{ $reply->reply }}
        </div>
        <img src="{{ url('images/'.$reply->image) }}" alt=""/>
      </div>
      <span class="post__headerSpecial account">
        <?php
          if ($reply->created_at == $reply->updated_at) {
            //
          } else {
            echo("Last edited · " . $reply->updated_at->format('H:i - d/m/y'));
          }
        ?>
      </span>
      <div class="d-flex justify-content-evenly my-3">
        <span class="material-icons icon"> mode_comment </span>
        <span class="material-icons icon"> repeat </span>
        <span class="material-icons icon"> favorite_border </span>
        <span class="material-icons icon"> stacked_bar_chart </span>
        <span class="material-icons icon"> ios_share </span>
      </div>
    </div>
  </div>
  <!-- post ends -->

  <!-- Modal -->
  <div class="modal fade" id="editReplyModal{{ $reply->id }}" tabindex="-1" aria-labelledby="editReplyModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('comment.update', $reply->id) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="ms-3 mt-2">
            <button type="button" class="btn-close icon__modal icon" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
                  
          <div class="modal-body">
            <div class="container p-2">
              <div class="row">
                <div class="col-sm-auto">
                  <img class="postImg" src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt=""/>
                </div>
                <div class="col">
                  <textarea class="tweetBox_textarea" name="reply" maxlength="255">{{ $reply->reply }}</textarea>                     
                  @if ($reply->image == 0)
                    <img src="" id="showImgCMT" class="tweetImg img-fluid mx-auto d-block" accept=".png, .jpg, .jpeg"/>
                  @else
                    <img src="{{ url('images/'.$reply->image) }}" id="showImgCMT{{$reply->id}}" class="tweetImg img-fluid mx-auto d-block" accept=".png, .jpg, .jpeg"/>
                  @endif
                  <div class="d-flex flex-row justify-content-between">
                    <div class="image-upload">
                      <label for="imgInpCMT">
                        <span class="material-icons icon"> add_a_photo </span>
                      </label>
                      <input type="file" class="fileCMT" id="imgInpCMT" name="image"/>
                      <span class="material-icons icon" onclick="deleteImgCMT()">hide_image</span>
                                      <script>                     
                                        imgInpCMT.onchange = evt => {
                                          const [file] = imgInpCMT.files
                                          if (file) {
                                            document.getElementById("showImgCMT").removeAttribute("src"); 
                                            showImgCMT.src = URL.createObjectURL(file)
                                          }
                                        }
                                      function deleteImgCMT() {  
                                        document.getElementById("showImgCMT").removeAttribute("src"); 
                                        const file = document.querySelector('.fileCMT');
                                        var emptyFile = document.createElement('input');
                                        emptyFile.type = 'file';
                                        file.files = emptyFile.files;
                                      }
                                      </script>
                    </div>
                    <div class="d-flex align-self-center">
                      <button type="submit" class="tweetBox__tweetButton">Update</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@empty
@endforelse
<!-- End Modal -->
<!-- comment end -->