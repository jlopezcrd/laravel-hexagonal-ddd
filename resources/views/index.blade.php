<h1 style="text-align: center;">-Welcome to SW Exchange System -</h1>

{!! $page->getHead() !!}

{!! $page->getBody() !!}

@if($page->isPage('home_page'))
    @foreach($gallery->items() as $product)
        <ul>
            <li>
                <a href="{{ $product->slug() }}">
                    {{ $product->name() }}</a>
                <span style="margin-left: 10px; margin-right: 10px">---></span>
                <a href="{{ route('updateCart', ['productId' => $product->uuid(), 'quantity' => 0]) }}">ADD TO CART</a>
            </li>
        </ul>
    @endforeach
@endif

<div style="margin-top: 15%"></div>

<p><a href="{{ route('index') }}">HOME PAGE</a></p>
<p><a href="{{ route('about') }}">ABOUT PAGE</a></p>
<p><a href="{{ route('gallery') }}">GALLERY PAGE</a></p>

<p><a href="{{ route('cart') }}">MY CART</a></p>
<p><a href="{{ route('savePurchase') }}">BUY</a></p>
<p><a href="{{ route('getAllPurchases') }}">PURCHASES</a></p>
