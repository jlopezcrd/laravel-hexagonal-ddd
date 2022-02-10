
{!! $page->getHead() !!}

{!! $page->getBody() !!}

@if($page->isPage('home_page'))
    @foreach($gallery->items() as $product)
        <ul>
            <li>
                <a href="{{ $product->slug() }}">
                    {{ $product->uuid() }}</a>
                {{ $product->name() }}
                <a href="{{ route('updateCart', ['productId' => $product->uuid()]) }}">ADD</a>
            </li>
        </ul>
    @endforeach
@endif

<a href="{{ route('index') }}">HOME PAGE</a>
<a href="{{ route('about') }}">ABOUT PAGE</a>
<a href="{{ route('gallery') }}">GALLERY PAGE</a>

<a href="{{ route('cart') }}">CART</a>
<a href="{{ route('savePurchase') }}">BUY</a>
<a href="{{ route('getAllPurchases') }}">PURCHASES</a>
