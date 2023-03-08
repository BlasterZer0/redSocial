<!-- widgets starts -->
<div class="widgets">
  <div class="widgets__input tweetbox__input">
    <span class="material-icons widgets__searchIcon"> search </span>
    <input type="text" placeholder="Search Twitter" />
  </div>

  <div class="widgets__widgetContainer">
    <h2>Who to follow</h2>
    <blockquote class="twitter-tweet">
      @for ($i = 0; $i < 3; $i++)
        <div class="sidebarOption">  
          <div class="flex-shrink-0">
            <span class="material-icons">
              <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" height="40" width="40"/>
            </span>
          </div>
          <div class="flex-grow-1 flex-column">
            <div>
              <span class="fw-bold account">
                {{ $user->find(1)->name }}
              </span>
            </div>
            <div>
              <span class="fw-light">
                {{ $user->find(1)->account }}
              </span>
            </div>        
          </div>
          <div class="d-flex align-self-center me-3">
            <button class="tweetBox__tweetButton">Follow</button>
          </div>
        </div>
      @endfor
    </blockquote>
  </div>
  
  <div class="widgets__widgetContainer">
    <h2>Trends for you</h2>
    <blockquote class="twitter-tweet">
      <div class="sidebarOption">  
        <div class="flex-grow-1 flex-column">
          <div><span class="post__headerSpecial"> Trending </span></div>
          <div><span class="fw-bold fs-5"> Clon </span></div>
          <div><span class="post__headerSpecial"> 404 Tweets </span></div> 
        </div>
        <div class="d-flex align-self-center me-3">
          <span class="material-icons ms-6"> more_horiz </span>
        </div>
      </div>
    </blockquote>
  </div>
</div>
<!-- widgets ends -->