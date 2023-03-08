<!-- feed starts -->
<div class="feed">
  <div class="feed__header">
    <h2>Home</h2>
  </div>

  <!-- tweetbox starts -->
  <div class="tweetBox">
    <form action="{{ route('tweet.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="container p-2">
        <div class="row">
          <div class="col-sm-auto">
            <img class="postImg" src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt=""/>
          </div>
          <div class="col">

            <textarea class="tweetBox_textarea" name="text" placeholder="What's happening?" maxlength="255"></textarea>
            <img src="" id="showImg" class="tweetImg img-fluid mx-auto d-block" accept=".png, .jpg, .jpeg"/>

            <div class="row">
              <div class="col">
                <div class="d-flex justify-content-between align-items-center">
                  <div class="image-upload p-2">
                    <label for="imgInp">
                      <span class="material-icons icon"> add_a_photo </span>
                    </label>
                    <input class="file" id="imgInp" name="image" type="file" />
                    <span class="material-icons icon" onclick="deleteImgFeed()">hide_image</span>
                  </div>
                  <script>
                    function deleteImgFeed() {
                      document.getElementById("showImg").removeAttribute("src"); 
                      const file = document.querySelector('.file');
                      var emptyFile = document.createElement('input');
                      emptyFile.type = 'file';
                      file.files = emptyFile.files;
                    }
                  </script>
                        <script>                     
                          imgInp.onchange = evt => {
                            const [file] = imgInp.files
                            if (file) {
                              showImg.src = URL.createObjectURL(file)
                            }
                          }
                        </script>
                  <div class="p-2">
                    <button class="tweetBox__tweetButton">Tweet</button>
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

  <!-- post starts -->
  @forelse ($tweets as $view)
    <div class="post px-3">
      <div class="post__avatar">
        <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt=""/>
      </div>

      <div class="post__body">
        <div class="post__header">
          <div class="post__headerText">
            <div class="row">
              <div class="d-flex flex-row mt-2 align-items-center">
                <div>
                  <span class="fw-bold fs-6 account">{{ $view->user->name }}</span>
                  <span class="material-icons post__badge"> verified </span>
                </div>
                <div class="flex-grow-1">
                  <span class="post__headerSpecial account">
                    {{ $view->user->account . " · " . $view->created_at->format('H:i - D j, o')}}
                  </span>
                </div>
                @if (Auth::user()->id === $view->user->id)
                  <div class="d-flex align-items-center justify-content-end dropstart me-3">
                    <span class="material-icons" data-bs-toggle="dropdown" aria-expanded="false"> more_horiz </span>
                    <ul class="dropdown-menu">
                      <li>
                        <a class="dropdown-item d-flex align-items-center text-danger">
                          <span class="material-icons"> delete_forever </span>
                            <form action="{{ route('tweet.destroy', $view) }}" method="post">
                              @method('DELETE')
                              @csrf
                              <button type="submit" class="btn btn-danger" onclick="return confirm('Delete Tweet?')">Delete</button>
                            </form>
                        </a>
                      </li>
                      <li>
                        <a id="{{ $view->id }}" class="dropdown-item d-flex align-items-center text-warning" data-bs-toggle="modal" data-bs-target="#editTweetModal{{$view->id}}">
                          <span class="material-icons"> drive_file_rename_outline </span>
                            Edit tweet
                        </a>
                      </li>
                    </ul>                  
                  </div>
                  @include('home.editModal')
                @endif
              </div>
            </div>              
          </div>
          
          <div class="post__headerDescription">
            {{ $view->text }}
          </div>
          <img class="img-fluid" src="{{ url('images/'.$view->image) }}" alt=""/>
        </div>
        <span class="post__headerSpecial account">
          <?php
            if ($view->created_at == $view->updated_at) {
              //
            } else {
              echo("Last edited · " . $view->updated_at->format('H:i - d/m/y'));
            }
          ?>
        </span>
        <div class="d-flex justify-content-evenly mt-3">
          <a href="{{ route('tweet.show', $view) }}"><span class="material-icons"> mode_comment </span></a>
          <span class="material-icons icon"> repeat </span>
          <span class="material-icons icon"> favorite_border </span>
          <span class="material-icons icon"> stacked_bar_chart </span>
          <span class="material-icons icon"> ios_share </span>
        </div>
      </div>
    </div>
    <!-- post ends -->
  @empty
    <!-- post example starts -->
    <div class="post">
      <div class="post__avatar">
        <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt=""/>
      </div>
      
      <div class="post__body">
        <div class="post__header">
          <div class="post__headerText">
            <div class="row">
              <div class="col-sm-auto d-flex align-items-center">
                <span class="fw-bold fs-6 account">{{ __('John doe') }}</span>
                <span class="material-icons post__badge"> verified </span>
                <span class="post__headerSpecial account">
                  {{ __('@johndoe · 00:00 - Jan 00, 2023') }}
                </span>
              </div>
              <div class="col d-flex justify-content-end dropstart">
                <span class="material-icons icon" data-bs-toggle="dropdown" aria-expanded="false"> more_horiz </span>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item d-flex align-items-center text-danger">
                      <span class="material-icons"> delete_forever </span>
                        <form action="#" method="post">
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Delete Tweet?')">Delete</button>
                        </form>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="dropdown-item d-flex align-items-center text-warning">
                      <span class="material-icons"> drive_file_rename_outline </span>
                      Edit tweet
                    </a>
                  </li>
                </ul>                  
              </div>
            </div>              
          </div>
          <div class="post__headerDescription">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
          </div>
        </div>
        <img src="https://www.focus2move.com/wp-content/uploads/2020/01/Tesla-Roadster-2020-1024-03.jpg" alt=""/>
        <div class="d-flex justify-content-evenly">
          <span class="material-icons icon"> mode_comment </span>
          <span class="material-icons icon"> repeat </span>
          <span class="material-icons icon"> favorite_border </span>
          <span class="material-icons icon"> stacked_bar_chart </span>
          <span class="material-icons icon"> ios_share </span>
        </div>
      </div>
    </div>
    <!-- post ends -->
  @endforelse
</div>
<!-- feed ends -->