<ul>
    @foreach($menus as $menu)
    <li><a href="{{ url($menu->page->url) }}">{{ $menu->title }}</a></li>
    @endforeach
</ul>