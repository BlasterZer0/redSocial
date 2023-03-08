<!-- Modal -->
<div class="modal fade" id="editTweetModal{{$view->id}}" tabindex="-1" aria-labelledby="editTweetModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('tweet.update', $view->id) }}" method="POST" enctype="multipart/form-data">
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
                                <textarea class="tweetBox_textarea" name="text" maxlength="255">{{ $view->text }}</textarea>
                                @if ($view->image == 0)
                                    <img src="" id="showImgTEM" class="tweetImg img-fluid mx-auto d-block" accept=".png, .jpg, .jpeg"/>
                                @else
                                    <img src="{{ url('images/'.$view->image) }}" id="showImgTEM" class="tweetImg img-fluid mx-auto d-block" accept=".png, .jpg, .jpeg"/>
                                @endif
                                <div class="d-flex flex-row justify-content-between">
                                    <div class="image-upload">
                                        <label for="imgInpTEM">
                                            <span class="material-icons icon"> add_a_photo </span>
                                        </label>
                                        <input type="file" class="fileModal" id="imgInpTEM" name="image"/>
                                        <span class="material-icons icon" onclick="deleteImgModal()">hide_image</span>
                                            <script>                     
                                            imgInpTEM.onchange = evt => {
                                                const [file] = imgInpTEM.files
                                                if (file) {
                                                document.getElementById("showImgTEM").removeAttribute("src"); 
                                                showImgTEM.src = URL.createObjectURL(file)
                                                }
                                            }
                                            </script>
                                            <script>
                                            function deleteImgModal() {
                                                document.getElementById("showImgTEM").removeAttribute("src"); 
                                                const file = document.querySelector('.fileModal');
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