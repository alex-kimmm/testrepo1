@if(count($failz) > 0)
@foreach($failz as $fail)

    @if( trim($fail->obj_link) != "")
    <div>
        <img src="{{ $fail->obj_link }}" width="100">
    </div>
    @endif

	<span class='st_facebook' st_url="{{ $fail->getUrl() }}" st_title="{{ $fail->title }}"></span>
    <span class='st_twitter' st_url="{{ $fail->getUrl() }}" st_title="{{ $fail->title }}"></span>

    {{ $fail->title }}.
    Likes: <span class="count_{{ $fail->id }}">{{ count($fail->likes) }}</span>.
    Tags: {{ count($fail->tags) }}
    @if(count($fail->tags) > 0) :
        @foreach($fail->tags as $tag)
            {{ $tag->name }},
        @endforeach
    @endif

    @if($fail->likeable)
    <button class="failz-like-button" data-fail-id="{{ $fail->id }}">Like</button>
    @else
    <button class="failz-like-button" data-fail-id="{{ $fail->id }}">Dislike</button>
    @endif

     <hr>


@endforeach
<script type="text/javascript">if (window.stButtons){stButtons.locateElements()}</script>
@endif
