<!-- sidebar starts -->
  @include('home.sidebar')
<!-- sidebar ends -->

<!-- feed starts -->
  <div class="feed">
    <div class="feed__header">
      <div class="d-flex flex-row align-items-center">
        <div class="me-4">
          <a href="{{ route('index') }}"><span class="material-icons"> arrow_back </span></a>
        </div>
        <div>
          <h2>Tweet</h2>
        </div>
      </div>
    </div>
    
    <!-- post starts -->
    <div class="container px-3">
      <div class="d-flex flex-row mt-3 mb-3">
        <div>
          <img class="postImg" src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt=""/>
        </div>
        <div class="flex-column align-items-center">
          <div>
            <span class="fw-bold fs-6 account">{{ $tweet->user->name }}</span>
            <span class="material-icons post__badge"> verified </span>
          </div>
          <div>
            <span class="post__headerSpecial account">
              {{ $tweet->user->account }}
            </span>
          </div>
        </div>
        @if (Auth::user()->id === $tweet->user->id)
        <div class="d-flex dropstart ms-auto">
          <span class="material-icons icon" data-bs-toggle="dropdown" aria-expanded="false"> more_horiz </span>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item d-flex align-items-center text-danger">
                <span class="material-icons"> delete_forever </span>
                <form action="{{ route('tweet.destroy', $tweet) }}" method="post">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Delete Tweet?')">Delete</button>
                </form>
              </a>
            </li>
            <li>
              <a id="{{ $tweet->id }}" href="{{ route('tweet.edit', $tweet) }}" class="dropdown-item d-flex align-items-center text-warning" data-bs-toggle="modal" data-bs-target="#editTweetModal{{$tweet->id}}">
                <span class="material-icons"> drive_file_rename_outline </span>
                Edit tweet
              </a>
            </li>
          </ul>                  
        </div>
        @endif
      </div>
      <div class="row post__headerDescription">
        <span class="text-break text-wrap">{{ $tweet->text }}</span>
      </div>
      <div class="row post__body">
        <img class="img-fluid" src="{{ url('images/'.$tweet->image) }}" alt=""/>
      </div>
      <div class="row">
        <span class="post__headerSpecial account">
          <?php
            if ($tweet->created_at == $tweet->updated_at) {
              echo($tweet->created_at->format('H:i - D j, o'));
            } else {
              echo("Last edited · " . $tweet->updated_at->format('H:i - d/m/y'));
            }
          ?>
        </span>
      </div>
      <div class="row my-3">
        <div class="border-top mb-3"></div>
        <div class="d-flex justify-content-evenly">
          <span class="material-icons icon"> mode_comment </span>
          <span class="material-icons icon"> repeat </span>
          <span class="material-icons icon"> favorite_border </span>
          <span class="material-icons icon"> ios_share </span>
        </div>
        <div class="border-bottom mt-3"></div>
      </div>
    </div>
    @include('tweet.comment')
  </div>
  <!-- Modal -->
  <div class="modal fade" id="editTweetModal{{$tweet->id}}" tabindex="-1" aria-labelledby="editTweetModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('tweet.update', $tweet->id) }}" method="POST" enctype="multipart/form-data">
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
                  <textarea class="tweetBox_textarea" name="text" maxlength="255">{{ $tweet->text }}</textarea>
                  @if ($tweet->image == 0)
                    <img src="" id="showImgTEM" class="tweetImg img-fluid mx-auto d-block" accept=".png, .jpg, .jpeg"/>
                  @else
                    <img src="{{ url('images/'.$tweet->image) }}" id="showImgTEM" class="tweetImg img-fluid mx-auto d-block" accept=".png, .jpg, .jpeg"/>
                  @endif                            
                  <div class="d-flex flex-row justify-content-between">
                    <div class="image-upload">
                      <label for="imgInpTEM">
                        <span class="material-icons icon"> add_a_photo </span>
                      </label>
                      <input type="file" class="file" id="imgInpTEM" name="image"/>
                      <span class="material-icons icon" onclick="deleteImg()">hide_image</span>
                                      <script>                     
                                        imgInpTEM.onchange = evt => {
                                          const [file] = imgInpTEM.files
                                          if (file) {
                                            document.getElementById("showImgTEM").removeAttribute("src"); 
                                            showImgTEM.src = URL.createObjectURL(file)
                                          }
                                        }

                                        function deleteImg() {
                                        document.getElementById("showImgTEM").removeAttribute("src"); 
                                        const file = document.querySelector('.file');
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
  <!-- End Modal -->
  <!-- feed ends -->

    <!-- widgets starts -->
    @include('home.widgets')
    <!-- widgets ends -->
  </body>
</html>