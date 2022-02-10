
{!! $page->getHead() !!}

{!! $page->getBody() !!}

@if($page->isPage('home_page'))
    @foreach($gallery->items() as $product)
        <ul>
            <li>{{ $product->name() }}</li>
        </ul>
    @endforeach
@endif
