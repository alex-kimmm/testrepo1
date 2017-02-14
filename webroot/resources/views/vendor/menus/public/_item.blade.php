<li id="menuitem_{{ $menulink->id }}" class="{{ $menulink->class }} {{ (Request::is(substr($menulink->url,1)) || Request::is(substr($menulink->url,1).'/*') ) ? ' active ': '' }} " role="menuitem">
@if($menulink->class == 'first')
    <span style="color: #f51847; font-weight: 500;">{{ $menulink->title }}</span>
@else
    <a href="{{ url($menulink->href) }}" @if($menulink->target) target="{{ $menulink->target }}" @endif class="{{ (Request::is(substr($menulink->url, 1)) || Request::is(substr($menulink->url, 1 ). '/*')) ? ' active ' : '' }}">
        @if ($menulink->icon_class)
            <span class="{{ $menulink->icon_class }}"></span>
        @endif
        {{ $menulink->title }}
        @if ($menulink->items->count())
            <span class="caret"></span>
        @endif
    </a>
@endif

@if ($menulink->items->count())
    <ul class="dropdown-menu">
        @foreach ($menulink->items as $menulink)
            @include('menus::public._item', ['menulink' => $menulink])
        @endforeach
    </ul>
@endif
</li>
