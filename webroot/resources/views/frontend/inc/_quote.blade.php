@if($quote)
<div class="insurance-age-mobile hidden-by-default">
    <div class="white">
        {!! $quote->processedMobileBody()  !!}
    </div>
    <div class="black">
        <div><span>{{$quote->title}}</span></div>
    </div>
</div>

<div class="insurance-age {{ $quote->position == QUOTE_ALIGN_LEFT ? 'quote-align-to-left' : 'quote-align-to-right' }} hidden-sm hidden-xs">
    <div class="white">
        {!! $quote->processedBody()  !!}
    </div>
    <div class="black">
        <div><span>
        @if($quote->redirect_url != null)
        <a class="quote-redirect-link" href="{{ $quote->redirect_url }}">{{ $quote->title }}</a>
        @else
        {{ $quote->title }}
        @endif
        </span></div>
    </div>
</div>
@endif