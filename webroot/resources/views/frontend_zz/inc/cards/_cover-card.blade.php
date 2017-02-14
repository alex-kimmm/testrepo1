<<<<<<< HEAD
@if($coverCard->button_link != null)
<div class="col-md-6 col-sm-6 cover-me-card cover-me-card-{{ $position }} original-cover-card" onclick="javascript:location.href='{{ $coverCard->button_link }}'" style="cursor: pointer">
@else
<div class="col-md-6 col-sm-6 cover-me-card cover-me-card-{{ $position }} original-cover-card">
@endif
=======
<div class="col-md-6 col-sm-6 cover-me-card cover-me-card-{{ $position }} original-cover-card">
>>>>>>> test
    <div class="music-musician-bg" style="background-image: url('{{ $coverCard->getImageUrl() }}');">
        <div class="desc">
            <div class="title">
                <span>{{ $coverCard->title }}</span>
            </div>
            <div class="description">
                {!! $coverCard->card_title !!}
            </div>
        </div>
    </div>
    @if($coverCard->button_link != null)
    <a class="btn btn-cover-me {{ $coverCard->button_link == null ? 'disable' : '' }}" href="{{ $coverCard->button_link }}" style="text-decoration: none;">
        {{ $coverCard->button_title }}
    </a>
    @else
    <div class="btn-cover-me text-center btn-cover-me-coming-soon" style="color: #aeaeae;"> {{ $coverCard->button_title }} </div>
    @endif
</div>