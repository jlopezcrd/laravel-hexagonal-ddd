<?php
declare(strict_types = 1);

namespace Developez\Front\Shared\Infrastructure;

use Developez\Front\AboutUs\Application\AboutUsFinder;
use Developez\Front\Cart\Application\CartCreator;
use Developez\Front\Cart\Application\CartSessionFinder;
use Developez\Front\Cart\Application\CartUpdater;
use Developez\Front\Contact\Application\ContactFinder;
use Developez\Front\Product\Application\ProductFinder;
use Developez\Front\Product\Application\ProductGalleryFinder;
use Developez\Front\Product\Application\ProductGallerySearcher;
use Developez\Front\Product\Application\ProductSearcher;
use Developez\Front\Product\Domain\ProductNotFoundException;
use Developez\Front\Purchase\Application\PurchaseCreator;
use Developez\Front\Purchase\Application\PurchaseSearcher;
use Developez\Shared\Domain\NotFoundException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FrontController
{
    public function index(Request $request, ProductGalleryFinder $galleryFinder): View
    {
        try {
            $page = [];
            $gallery = $galleryFinder();

            return view('index')
                ->with(['page' => $page, 'gallery' => $gallery, 'slider' => true]);
        } catch (NotFoundException $e) {
            if(config('app.debug')) {
                dd($e);
            }
            return abort(404);
        }
    }

    public function about_us(Request $request, AboutUsFinder $finder): View
    {
        return view('about_us')->with('slider', false);
        //TODO
        try {
            $page = $finder();

            return view('about_us')
                ->with(['page' => $page]);
        } catch (NotFoundException $e) {
            if(config('app.debug')) {
                dd($e);
            }
            return abort(404);
        }
    }

    public function gallery(Request $request, ProductGallerySearcher $searcher): View
    {
        dd($searcher($request->query()));

        $products = $searcher([
            'and' => $request->query('and', []),
            'or'  => $request->query('or', [])
        ]);

        return view('gallery')
            ->with(['products' => $products]);
    }

    public function gallery_category(Request $request, ProductGallerySearcher $searcher, string $category): View
    {
        $products = $searcher(['category' => $category], []);

        return view('gallery-category')
            ->with(['products' => $products, 'category' => $category, 'slider' => false]);
    }

    public function gallery_detail(Request $request, ProductFinder $finder, string $category, string $slug): View
    {
        $product = $finder->findBySlug($category, $slug);

        return view('gallery-details')
            ->with(['product' => $product, 'slider' => false]);
    }

    public function contact(Request $request, ContactFinder $finder): View
    {
        return view('contact')->with('slider', false);
        //TODO
        try {
            $page = $finder();

            return view('contact')
                ->with(['page' => $page]);
        } catch (NotFoundException $e) {
            if(config('app.debug')) {
                dd($e);
            }
            return abort(404);
        }
    }

    public function shop(Request $request, CartCreator $creator, ProductSearcher $searcher): View
    {
        $creator();
        $products = $searcher($request->query());

        return view('gallery')
            ->with(['products' => $products]);
    }

    public function cart(ProductFinder $finder, CartUpdater $updater): string
    {
        return $updater($finder("2"), 1)->toJson();
    }

    public function updateCart(Request $request, ProductFinder $finder, CartUpdater $updater): JsonResponse
    {
        try {
            if(!$request->has('productId')) {
                return response()->json([
                    'msg' => 'Validation error'
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

            $product = $finder((int) $request->input('productId'));
            $cart    = $updater($product, 1);

            return response()->json([
                'msg' => 'ok',
                'cart' => $cart->toArray()
            ], JsonResponse::HTTP_OK);
        } catch (ProductNotFoundException $exception) {
            return response()->json([
                'msg' => $exception->getMessage()
            ], JsonResponse::HTTP_NOT_FOUND);
        }
    }

    public function savePurchase(Request $request, CartSessionFinder $cartFinder, PurchaseCreator $creator): JsonResponse
    {
        $purchase = $creator($cartFinder());

        return response()->json([
            'msg'      => 'ok',
            'purchase' => $purchase->orderId()->value()
        ], JsonResponse::HTTP_OK);
    }

    public function getAllPurchases(Request $request, PurchaseSearcher $searcher): JsonResponse
    {
        $purchases = $searcher();
        return response()->json([
            'msg'       => 'ok',
            'purchases' => $purchases->toArray()
        ], JsonResponse::HTTP_OK);
    }
}
