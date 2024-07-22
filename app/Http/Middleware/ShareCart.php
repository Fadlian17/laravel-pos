<?php

namespace App\Http\Middleware;
use Closure;
use \App\Cart;
use \App\Http\Services\CartService;

class ShareCart
{
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if($user){
            $cart = Cart::where('user_id', $request->user()->id)->where('status','0')->get();
            // dd($cart->count());
            view()->share('cart', $cart);
        }else{
            $cart = $this->cartService->getContent();
            view()->share('cart', $cart);
        }
        return $next($request);
    }
}
