<?php

declare(strict_types = 1);

namespace Developez\Front\Shared\Infrastructure;

use Developez\Front\AboutUs\Application\AboutUsFinder;
use Developez\Front\HomePage\Application\HomePageFinder;
use Developez\Front\Cart\Application\CartCreator;
use Developez\Front\Cart\Application\CartSessionFinder;
use Developez\Front\Cart\Application\CartUpdater;
use Developez\Front\Product\Application\ProductFinder;
use Developez\Front\Product\Application\ProductGalleryFinder;
use Developez\Front\Product\Application\ProductGallerySearcher;
use Developez\Front\Product\Application\ProductSearcher;
use Developez\Front\Purchase\Application\PurchaseCreator;
use Developez\Front\Purchase\Application\PurchaseSearcher;
use DomainException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class FrontController
{
    public function index(Request $request, HomePageFinder $finder, ProductGalleryFinder $galleryFinder): View
    {
        $page = $finder();
        $gallery = $galleryFinder();

        //TODO => dd($page, $gallery);

        return view('index')
            ->with('page', $page)
            ->with('gallery', $gallery);
    }

    public function about_us(Request $request, AboutUsFinder $finder): View
    {
        $page = $finder->__invoke();

        return view('index')
            ->with('page', $page);
    }

    public function gallery(Request $request, ProductGallerySearcher $searcher): View
    {
        //dd($searcher([], ['category' => ['MURALES']]));
        dd($searcher(['is_painting' => false, 'on_gallery' => true], $request->query()));
    }

    public function gallery_category(Request $request, ProductGallerySearcher $searcher, string $category): View
    {
        $products = $searcher(['category' => $category], []);
        dd($products);
    }

    public function gallery_detail(Request $request, ProductFinder $finder, string $category, string $slug): View
    {
        $product = $finder->findBySlug($category, $slug);
        dd($product);
    }

    public function shop(Request $request, CartCreator $creator, ProductSearcher $searcher): View
    {
        $creator();
        $products = $searcher($request->query());
        dd($products);
    }

    public function cart(CartSessionFinder $finder): string
    {
        dd($finder());
    }

    public function updateCart(Request $request, ProductFinder $finder, CartUpdater $updater): JsonResponse
    {
        try {
            $product = $finder($request->input('productId', ''));
            $cart    = $updater($product, (int) $request->input('quantity', 0));

            return response()->json([
                'msg' => 'ok',
                'cart' => $cart->toArray()
            ], Response::HTTP_OK);
        } catch (DomainException $exception) {
            return response()->json([
                'msg' => $exception->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function savePurchase(Request $request, CartSessionFinder $cartFinder, PurchaseCreator $creator): JsonResponse
    {
        $purchase = $creator($cartFinder());

        //$request->session()->flush(); //TODO REMOVE

        return response()->json([
            'msg'      => 'ok',
            'purchase' => $purchase->orderId()->value()
        ], Response::HTTP_OK);
    }

    public function getAllPurchases(Request $request, PurchaseSearcher $searcher): JsonResponse
    {
        $purchases = $searcher();

        return response()->json([
            'msg'       => 'ok',
            'purchases' => $purchases->toArray()
        ], Response::HTTP_OK);
    }
}
