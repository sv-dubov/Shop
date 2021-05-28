<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    private $basket;

    public function __construct() {
        $this->basket = Basket::getBasket();
    }

    public function index() {
        $products = $this->basket->products;
        $amount = $this->basket->getAmount();
        return view('basket.index', compact('products', 'amount'));
    }

    public function checkout(Request $request) {
        $profile = null;
        $profiles = null;
        if (auth()->check()) {
            $user = auth()->user();
            $profiles = $user->profiles;
            $prof_id = (int)$request->input('profile_id');
            if ($prof_id) {
                $profile = $user->profiles()->whereIdAndUserId($prof_id, $user->id)->first();
            }
        }
        return view('basket.checkout', compact('profiles', 'profile'));
    }

    public function add(Request $request, $id) {
        $quantity = $request->input('quantity') ?? 1;
        $this->basket->increase($id, $quantity);
        if ( ! $request->ajax()) {
            return back();
        }
        $positions = $this->basket->products->count();
        return view('basket.partial.basket', compact('positions'));
    }

    public function plus($id) {
        $this->basket->increase($id);
        return redirect()->route('basket.index');
    }

    public function minus($id) {
        $this->basket->decrease($id);
        return redirect()->route('basket.index');
    }

    public function remove($id) {
        $this->basket->remove($id);
        return redirect()->route('basket.index');
    }

    public function clear() {
        $this->basket->delete();
        return redirect()->route('basket.index');
    }

    public function saveOrder(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:255',
            'address' => 'required',
        ]);
        $user_id = auth()->check() ? auth()->user()->id : null;
        $order = Order::create(
            $request->all() + ['amount' => $this->basket->getAmount(), 'user_id' => $user_id]
        );
        foreach ($this->basket->products as $product) {
            $order->items()->create([
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $product->pivot->quantity,
                'cost' => $product->price * $product->pivot->quantity,
            ]);
        }
        $this->basket->clear();
        return redirect()->route('basket.success')->with('order_id', $order->id);
    }

    public function success(Request $request) {
        if ($request->session()->exists('order_id')) {
            $order_id = $request->session()->pull('order_id');
            $order = Order::findOrFail($order_id);
            return view('basket.success', compact('order'));
        } else {
            return redirect()->route('basket.index');
        }
    }

    public function profile(Request $request) {
        if ( ! $request->ajax()) {
            abort(404);
        }
        if ( ! auth()->check()) {
            return response()->json(['error' => 'Auth needed!'], 404);
        }
        $user = auth()->user();
        $profile_id = (int)$request->input('profile_id');
        if ($profile_id) {
            $profile = $user->profiles()->whereIdAndUserId($profile_id, $user->id)->first();
            if ($profile) {
                return response()->json(['profile' => $profile]);
            }
        }
        return response()->json(['error' => 'Profile was not found!'], 404);
    }
}
