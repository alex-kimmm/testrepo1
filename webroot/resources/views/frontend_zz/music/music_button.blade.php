@if($musicCard->getTrackFileUrl())
<div id="jquery_jplayer_{{$musicCard->id}}" data-cpcontainer="cp_container_{{$musicCard->id}}" class="cp-jplayer" data-src="{{$musicCard->getTrackFileUrl()}}"></div>

<!-- The container for the interface can go where you want to display it. Show and hide it as you need. -->

<div id="cp_container_{{$musicCard->id}}" class="cp-container">
    <div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
        <div class="cp-buffer-1"></div>
        <div class="cp-buffer-2"></div>
    </div>
    <div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
        <div class="cp-progress-1"></div>
        <div class="cp-progress-2"></div>
    </div>
    <div class="cp-circle-control"></div>
    <ul class="cp-controls">
        <li><a class="cp-play" tabindex="1">play</a></li>
        <li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
    </ul>
</div>
@endif