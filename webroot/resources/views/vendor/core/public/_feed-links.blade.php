@foreach(config('typicms.feeds', []) as $feed)
    {!! Feed::link(route($lang.'.'.$feed['module'].'.feed'), 'atom', trans($feed['module'].'::global.feed').' – '.$websiteTitle, $lang) !!}
@endforeach
