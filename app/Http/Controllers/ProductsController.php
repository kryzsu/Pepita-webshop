<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ProductsController extends Controller
{
    public function index() {

        $products = Products::paginate(9);

        return view('products.index', [
            'products' => $products,
        ]);
    }

    public function show($id = null) {
        $product = Products::findOrFail($id);
        
        return view('products.show', ['product' => $product]);
        
    }

    public function cart() {
        
        if(!session()->has('cart') || session()->get('cart')->totalQty === 0){
            return view('products.cart', ['products' => null]);
        }
        $cart = new Cart(session()->get('cart'));

        return view('products.cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);

        return view('products.cart');
        
    }

    public function getAddToCart(Request $request, $id) {
        $product = Products::find($id);
        //van már termék a kosárban?
        $oldCart = session()->has('cart') ? session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request = session()->put('cart', $cart);

        return redirect('products');
    }

    public function destroy($id) {
     
        if(session()->has('cart')){
            
            $oldCart = session()->get('cart');
            $cart = new Cart($oldCart);
            $cart -> destroy($id);
            session()->put('cart', $cart);
        }
       
        return redirect('products/cart');
    }

    public function destroyOrder($id) {
        if(Auth::user()->email == 'admin@admin.com'){
            $order = Order::find($id);
            $order->delete();

        return redirect('products/order');

        }
        return redirect('products');
    }

    public function search(Request $request){
        $search = $request->input('search');
      
        $products = Products::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->paginate(10);
        return view('products.index', compact('products'));
    }

    public function checkout(){
        if(!session()->has('cart')){
            //termék nélküli fizetés szűrése
            return redirect('products');
        }else{
            if(!Auth::check()){
                //felhasználó beléptetés
                return redirect('login')->with('msg', 'A fizetéshez kérjük jelentkezzen be!');
            }
            $oldCart = session()->get('cart');
            $cart = new Cart($oldCart);

            //Rendelés mentése
            $order = new Order;
            $order->cart = serialize($cart);
            $order->user_id = Auth::user()->id;
            $order->save();
            session()->forget('cart');
            return redirect('products/order');
        }
        
    }

    public function order(){
        if(!Auth::check()){
            return redirect('login')->with('msg', 'A rendeléshez kérjük jelentkezzen be!');
        } else {
            if(Auth::user()->email == 'admin@admin.com'){
                //pwd:admin123
                $orders = DB::table('users')
                ->join('orders', 'users.id', '=', 'orders.user_id')
                //->select('users.name', 'orders.cart')
                ->get();

                $orders->transform(function($order, $key){
                    $order->cart = unserialize($order->cart);
                    return $order;
                });
            }else{
                $orders = Order::query()
                ->where('user_id', Auth::user()->id)
                ->get();
                $orders->transform(function($order, $key){
                    $order->cart = unserialize($order->cart);
                    return $order;
                });
            }
        }

        
        return view('products.orders', ['orders' => $orders]);
    }
}
