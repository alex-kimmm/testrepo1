@if($missed > 0 && $missed < $range)
    @for($i =0; $i < $missed; $i++)
        <div class="{{$class}}">
            <div class="cards {{$themes[($i % count($themes))+(3-$missed)]}}"></div>
        </div>
    @endfor
@endif