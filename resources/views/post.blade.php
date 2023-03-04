<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Twitter Clone - Final</title>
    <link rel="stylesheet" href="{{ URL::asset('/css/styles.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
      crossorigin="anonymous"
    />
    <link 
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet" 
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" 
      crossorigin="anonymous"
    />
    <script 
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" 
      crossorigin="anonymous">
    </script>
  </head>
  <body>
    <!-- sidebar starts -->
    <div class="sidebar">
      <i class="fab fa-twitter"></i>
      <div class="sidebarOption active">
        <span class="material-icons"> home </span>
        <h2>Home</h2>
      </div>

      <div class="sidebarOption">
        <span class="material-icons"> tag </span>
        <h2>Explore</h2>
      </div>

      <div class="sidebarOption">
        <span class="material-icons"> notifications_none </span>
        <h2>Notifications</h2>
      </div>

      <div class="sidebarOption">
        <span class="material-icons"> mail_outline </span>
        <h2>Messages</h2>
      </div>

      <div class="sidebarOption">
        <span class="material-icons"> bookmark_border </span>
        <h2>Bookmarks</h2>
      </div>

      <div class="sidebarOption">
        <span class="material-icons"> list_alt </span>
        <h2>Lists</h2>
      </div>

      <div class="sidebarOption">
        <span class="material-icons"> perm_identity </span>
        <h2>Profile</h2>
      </div>

      <div class="sidebarOption">
        <span class="material-icons"> more_horiz </span>
        <h2>More</h2>
      </div>

      <!-- Button trigger modal -->
      <button class="sidebar__tweet" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tweet
      </button>

      <!-- Modal -->
      <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="{{ route('tweet.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="container p-2">
                  <div class="row">
                    <div class="col-sm-auto">
                      <img class="postImg" src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt=""/>
                    </div>
                    <div class="col">
                      <textarea class="tweetBox_textarea" name="text" placeholder="What's happening?" maxlength="255"></textarea>
                      <img id="showImgTCM" class="tweetImg img-fluid mx-auto d-block" accept=".png, .jpg, .jpeg"/>
                        <div class="row">
                          <div class="col">
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="p-2">
                                <div class="image-upload">
                                  <label for="imgInpTCM">
                                    <span class="material-icons"> add_a_photo </span>
                                  </label>
                                  <input id="imgInpTCM" name="image" type="file"/>
                                  <script>                     
                                    imgInpTCM.onchange = evt => {
                                      const [file] = imgInpTCM.files
                                      if (file) {
                                        showImgTCM.src = URL.createObjectURL(file)
                                      }
                                    }
                                  </script>
                                </div>
                              </div>
                              <div class="p-2">
                                <button class="tweetBox__tweetButton">Tweet</button>
                              </div>
                            </div>
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

      <div class="sidebarOption dropup" data-bs-toggle="dropdown" aria-expanded="false">  
        <span class="material-icons">
          <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" height="40" width="40"/>
        </span>
        <div class="row">
          <span class="fw-bold">{{ Auth::user()->name }}</span>
          <span class="fw-light">{{ Auth::user()->account }}</span>
        </div>
        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item fw-bold" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            {{ __('Log out ' . Auth::user()->account) }}</a>
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
        </ul>
      </div>
    </div>
    <!-- sidebar ends -->

    <!-- feed starts -->
    <div class="feed">
      <div class="feed__header">
        <h2>Tweet</h2>
      </div>
      <!-- post starts -->
      <div class="container">
        <div class="d-flex flex-row mt-3">
          <div class="mb-3">
            <img class="postImg" src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt=""/>
          </div>
          <div class="d-flex flex-column">
            <div class="d-flex align-items-center">
              <span class="fw-bold fs-6 account">{{ $tweet->user->name }}</span>
              <span class="material-icons post__badge"> verified </span>
            </div>
            <div class="d-flex align-items-center">
              <span class="post__headerSpecial account">
                {{ $tweet->user->account }}
              </span>
            </div>
          </div>
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
        </div>
        <div class="d-flex flex-column">
          <div style="width:580px;">
            <div class="post__headerDescription">
              <span class="text-break text-wrap">{{ $tweet->text }}</span>
            </div>
          </div>
          <div>
            <div class="post__body">
              <img class="img-fluid" src="{{ url('images/'.$tweet->image) }}" alt=""/>
            </div>
          </div>
          <div>
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
        </div>
      </div>

      <div class="post mt-3">
      </div>

      <div class="d-flex justify-content-evenly mt-3">
        <span class="material-icons icon"> mode_comment </span>
        <span class="material-icons icon"> repeat </span>
        <span class="material-icons icon"> favorite_border </span>
        <span class="material-icons icon"> ios_share </span>
      </div>

      <div class="post mt-3">
      </div>

        <!-- Modal -->
          <div class="modal fade" id="editTweetModal{{$tweet->id}}" tabindex="-1" aria-labelledby="editTweetModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="{{ route('tweet.update', $tweet->id) }}" method="POST" enctype="multipart/form-data">
                  @method('PUT')
                  @csrf
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container p-2">
                      <div class="row">
                        <div class="col-sm-auto">
                          <img class="postImg" src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt=""/>
                        </div>
                        <div class="col">
                          <textarea class="tweetBox_textarea" name="text" maxlength="255">{{ $tweet->text }}</textarea>
                          <div class="row">                            
                            <div class="col">
                              <img src="{{ url('images/'.$tweet->image) }}" id="showImgTEM" class="tweetImg img-fluid mx-auto d-block" accept=".png, .jpg, .jpeg"/>
                            </div>
                            <div class="col-sm-auto">
                              <span class="material-icons" onclick="deleteImg()">hide_image</span>
                            </div>
                          </div>
                            <div class="row">
                              <div class="col">
                                <div class="d-flex justify-content-between align-items-center">
                                  <div class="p-2">
                                    <div class="image-upload">
                                      <label for="imgInpTEM">
                                        <span class="material-icons"> add_a_photo </span>
                                      </label>
                                      <input type="file" class="file" id="imgInpTEM" name="image"/>
                                      <script>                     
                                        imgInpTEM.onchange = evt => {
                                          const [file] = imgInpTEM.files
                                          if (file) {
                                            document.getElementById("showImgTEM").removeAttribute("src"); 
                                            showImgTEM.src = URL.createObjectURL(file)
                                          }
                                        }
                                      </script>
                                    </div>
                                  </div>
                                  <div class="p-2">
                                    <script>
                                      function deleteImg() {
                                        document.getElementById("showImgTEM").removeAttribute("src"); 
                                        const file = document.querySelector('.file');
                                        var emptyFile = document.createElement('input');
                                        emptyFile.type = 'file';
                                        file.files = emptyFile.files;
                                      }
                                    </script>
                                    <button type="submit" class="tweetBox__tweetButton">Update</button>
                                  </div>
                                </div>
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
                  <textarea class="tweetBox_textarea" name="text" placeholder="Tweet your reply" maxlength="255"></textarea>
                  <img id="showImg" class="tweetImg img-fluid mx-auto d-block" accept=".png, .jpg, .jpeg"/>
                <div class="row">
                  <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="p-2">
                        <div class="image-upload">
                          <label for="imgInp">
                            <span class="material-icons"> add_a_photo </span>
                          </label>
                          <input id="imgInp" name="image" type="file" />
                        </div>
                        <script>                     
                          imgInp.onchange = evt => {
                            const [file] = imgInp.files
                            if (file) {
                              showImg.src = URL.createObjectURL(file)
                            }
                          }
                        </script>
                  </div>
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
        <div class="post">
          <div class="post__avatar">
            <img
              src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png"
              alt=""
            />
          </div>

          <div class="post__body">
            <div class="post__header">
              <div class="post__headerText">
                  <div class="row">
                    <div class="col-sm-auto d-flex align-items-center">
                      <span class="fw-bold fs-6 account">{{ $tweet->user->name }}</span>
                      <span class="material-icons post__badge"> verified </span>
                      <span class="post__headerSpecial account">
                        {{ $tweet->user->account . " · " . $tweet->created_at->format('H:i - D j, o')}}
                      </span>
                    </div>
                    <div class="col d-flex justify-content-end dropstart">
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
                          <a id="{{ $tweet->id }}" class="dropdown-item d-flex align-items-center text-warning" data-bs-toggle="modal" data-bs-target="#editTweetModal{{$tweet->id}}">
                            <span class="material-icons"> drive_file_rename_outline </span>
                            Edit tweet
                          </a>
                        </li>
                      </ul>                  
                    </div>
                  </div>     
                  <div class="row">
                    <div class="col-sm-auto d-flex align-items-center">
                      <span class="post__headerSpecial">
                        Replying to <span class="text-primary account">{{ $tweet->user->account }}</span>
                      </span>
                    </div>
                  </div>         
              </div>
              <div class="post__headerDescription">
                {{ $tweet->text }}
              </div>
              <img src="{{ url('images/'.$tweet->image) }}" alt=""/>
            </div>
            <span class="post__headerSpecial account">
              <?php
                if ($tweet->created_at == $tweet->updated_at) {
                  //
                } else {
                  echo("Last edited · " . $tweet->updated_at->format('H:i - d/m/y'));
                }
              ?>
            </span>
            
            <div class="d-flex justify-content-evenly mt-3">
              <a href="{{ route('tweet.edit', $tweet) }}"><span class="material-icons"> mode_comment </span></a>
              <span class="material-icons icon"> repeat </span>
              <span class="material-icons icon"> favorite_border </span>
              <span class="material-icons icon"> stacked_bar_chart </span>
              <span class="material-icons icon"> ios_share </span>
            </div>
          </div>
        </div>
        <!-- post ends -->

        <!-- Modal -->
          <div class="modal fade" id="editTweetModal{{$tweet->id}}" tabindex="-1" aria-labelledby="editTweetModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="{{ route('tweet.update', $tweet->id) }}" method="POST" enctype="multipart/form-data">
                  @method('PUT')
                  @csrf
                  <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container p-2">
                      <div class="row">
                        <div class="col-sm-auto">
                          <img class="postImg" src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt=""/>
                        </div>
                        <div class="col">
                          <textarea class="tweetBox_textarea" name="text" maxlength="255">{{ $tweet->text }}</textarea>
                          <div class="row">                            
                            <div class="col">
                              <img src="{{ url('images/'.$tweet->image) }}" id="showImgTEM" class="tweetImg img-fluid mx-auto d-block" accept=".png, .jpg, .jpeg"/>
                            </div>
                            <div class="col-sm-auto">
                              <span class="material-icons" onclick="deleteImg()">hide_image</span>
                            </div>
                          </div>
                            <div class="row">
                              <div class="col">
                                <div class="d-flex justify-content-between align-items-center">
                                  <div class="p-2">
                                    <div class="image-upload">
                                      <label for="imgInpTEM">
                                        <span class="material-icons"> add_a_photo </span>
                                      </label>
                                      <input type="file" class="file" id="imgInpTEM" name="image"/>
                                      <script>                     
                                        imgInpTEM.onchange = evt => {
                                          const [file] = imgInpTEM.files
                                          if (file) {
                                            document.getElementById("showImgTEM").removeAttribute("src"); 
                                            showImgTEM.src = URL.createObjectURL(file)
                                          }
                                        }
                                      </script>
                                    </div>
                                  </div>
                                  <div class="p-2">
                                    <script>
                                      function deleteImg() {
                                        document.getElementById("showImgTEM").removeAttribute("src"); 
                                        const file = document.querySelector('.file');
                                        var emptyFile = document.createElement('input');
                                        emptyFile.type = 'file';
                                        file.files = emptyFile.files;
                                      }
                                    </script>
                                    <button type="submit" class="tweetBox__tweetButton">Update</button>
                                  </div>
                                </div>
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
      <!-- comment starts -->
    </div>
    <!-- feed ends -->

    <!-- widgets starts -->
    <div class="widgets">
      <div class="widgets__input tweetbox__input">
        <span class="material-icons widgets__searchIcon"> search </span>
        <input type="text" placeholder="Search Twitter" />
      </div>

      <div class="widgets__widgetContainer">
        <h2>What's happening?</h2>
        <blockquote class="twitter-tweet">
          <p lang="en" dir="ltr">
            Sunsets don&#39;t get much better than this one over
            <a href="https://twitter.com/GrandTetonNPS?ref_src=twsrc%5Etfw">@GrandTetonNPS</a>.
            <a href="https://twitter.com/hashtag/nature?src=hash&amp;ref_src=twsrc%5Etfw"
              >#nature</a
            >
            <a href="https://twitter.com/hashtag/sunset?src=hash&amp;ref_src=twsrc%5Etfw"
              >#sunset</a
            >
            <a href="http://t.co/YuKy2rcjyU">pic.twitter.com/YuKy2rcjyU</a>
          </p>
          &mdash; US Department of the Interior (@Interior)
          <a href="https://twitter.com/Interior/status/463440424141459456?ref_src=twsrc%5Etfw"
            >May 5, 2014</a
          >
        </blockquote>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
      </div>
    </div>
    <!-- widgets ends -->
  </body>
</html>