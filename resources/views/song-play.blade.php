@if (isset($song))
    <div class="nav_bar_bottom">
        <div class="sx">
            <a href="#"><img src="{{ $song->image }}" alt="Now playing"></a>
            <div class="box_info">
                <a href="#"><span>{{ $song->artist->name }}</span></a>
                <a class="pink_floyd" href="#"><span>{{ $song->name }}</span></a>
            </div>
            <a class="heart" href="#"><i class="far fa-heart"></i></a>
            <a class="folder" href="#"><i class="far fa-folder"></i></a>
        </div>
        <div class="center">
            <div class="top">
                <a class="random-song" href="#"><i class="fas fa-random"></i></a>
                <a class="prev-song" href="" data-id="{{ $song->id }}"><i class="fas fa-step-backward"></i></a>
                <a class="play" href="#">
                    <i class="far fa-play-circle icon-play"></i>
                    <i class="far fa-pause-circle icon-pause"></i>
                </a>
                <a class="next-song" href="" data-id="{{ $song->id }}"><i class="fas fa-step-forward"></i></a>
                <a class="repeat-song" href="#"><i class="fas fa-redo-alt"></i></a>
            </div>  
            <div class="bottom">
                <span class="current-time"></span>
                <input id="progress" class="progress" type="range" value="0" step="1" min="0" max="100">
                <span class="audio-duration"></span>
                <audio id="audio" src="{{ $song->link }}"></audio>
            </div>
        </div>
        <div class="dx">
            <a href="#"><i class="fas fa-list-ul"></i></a>
            <a href="#"><i class="fas fa-desktop"></i></a>
            <input id="volProgress" class="volProgress" type="range" value="0.5" step="0.05" min="0" max="1">    
        </div>
    </div>
@endif  
