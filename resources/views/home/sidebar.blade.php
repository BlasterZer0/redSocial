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

      <div class="sidebarOption dropup-center dropup mt-3" data-bs-toggle="dropdown" aria-expanded="false">  
        <div class="flex-shrink-0">
          <span class="material-icons">
            <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" height="40" width="40"/>
          </span>
        </div>

        <div class="flex-grow-1 flex-column">
          <div><span class="fw-bold">{{ Auth::user()->name }}</span></div>
          <div><span class="fw-light">{{ Auth::user()->account }}</span></div>        
        </div>
        <span class="material-icons"> more_horiz </span>
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

    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('tweet.store') }}" method="POST" enctype="multipart/form-data">
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
                    <textarea class="tweetBox_textarea" name="text" placeholder="What's happening?" maxlength="255"></textarea>
                    <img src="" id="showImgTCM" class="tweetImg img-fluid mx-auto d-block" accept=".png, .jpg, .jpeg"/>
                    <div class="d-flex flex-row justify-content-between">
                      <div class="image-upload">
                        <label for="imgInpTCM">
                          <span class="material-icons icon"> add_a_photo </span>
                        </label>
                        <input class="fileModal1" id="imgInpTCM" name="image" type="file"/>
                        <span class="material-icons icon" onclick="deleteImgM()">hide_image</span>
                        <script>                     
                          imgInpTCM.onchange = evt => {
                          const [file] = imgInpTCM.files
                            if (file) {
                              showImgTCM.src = URL.createObjectURL(file)
                            }
                          }

                          function deleteImgM() {
                                                document.getElementById("showImgTCM").removeAttribute("src"); 
                                                const file = document.querySelector('.fileModal1');
                                                var emptyFile = document.createElement('input');
                                                emptyFile.type = 'file';
                                                file.files = emptyFile.files;
                                                }
                        </script>
                      </div>
                      <div class="d-flex align-self-center">
                        <button class="tweetBox__tweetButton">Tweet</button>
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
  </body>
</html>