@if($page)
<a class="{{ $anchor }}" href="{{ url($page->url) }}">{{ $page->name }}</a>
@else
<a class="{{ $anchor }}" href="#">{{ $menu->title }}</a>
@endif