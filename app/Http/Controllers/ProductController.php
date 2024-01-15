<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\OrderItem;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view("shop",compact("products"));
    }

    public function create()
    {
        return view("create-product");
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('product.index')->withErrors($validator);
        }
    
        $originalFileName = null;
    
        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('public/images', $originalFileName);
        }
    
        $product = Product::create([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'image' => 'images/' . $originalFileName,
        ]);
    
        return redirect()->route('product.index')->with('success', 'Inserted Product');
    }      

    public function edit($id)
    {
        $product = Product::where("id",$id)->first();
        return view("edit-product",compact("product"));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp',
        ]);
    
        $product = Product::where('id', $id)->first();
        $product->name=$request->get('name');
        $product->price=$request->get('price');
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs('public/images', $request->file('image')->getClientOriginalName());
            $product->image = 'images/' . $request->file('image')->getClientOriginalName();
        }
        $product->save();

        return redirect()->route('product.index')->with('success', 'Updated Product');
    }

    public function destroy($id)
    {
        $product = Product::where("id",$id)->first();

        $imageFilename = str_replace('images/', '', $product->image);
    
        $photoPath = 'public/images/' . $imageFilename;

        if (Storage::disk('local')->exists($photoPath)) {
            Storage::disk('local')->delete($photoPath);
        }

        $product->delete();
    
        return redirect()->route('product.index')->with('success','Deleted Product');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $products = Product::where("name","LIKE","%$search%")->get();
        
        return view("shop",compact("products"));
    }

    public function featuredProducts()
    {
        $products = Product::take(8)->get();
        return $products;
    }    

    public function cart()
    {
        $cartItems = [];
    
        if (auth()->check()) {
            $order = Order::where('user_id', auth()->user()->id)->latest()->first();
            if ($order) {
                $cartItems = OrderItem::where('order_id', $order->id)->get();
            }
        }
    
        return view('cart', compact('cartItems'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product has been added to cart!');
    }
    
    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Product added to cart.');
        }
    }
  
    public function deleteFromCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully deleted.');
        }
    }

    public function checkout()
    {
        $cartData = session('cart');

        $totalCartPrice = 0;
        foreach ($cartData as $item) {
            $totalCartPrice += $item['price'] * $item['quantity'];
        }
        
        return view('checkout', ['cartItems' => $cartData, 'totalCartPrice' => $totalCartPrice]);
    }    

    public function processCheckout(Request $request)
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'first_name' => $request->input('firstName'),
            'last_name' => $request->input('lastName'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'address2' => $request->input('address2'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
            'zip' => $request->input('zip'),
        ]);

        foreach ($request->session()->get('cart', []) as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'product_image' => $item['image'],
                'quantity' => $item['quantity'],
                'total_price' => $item['price'] * $item['quantity'],
            ]);
        }

        $request->session()->forget('cart');

        return redirect()->route('product.orderConfirmation')->with('success', 'Order placed successfully!');
    }      

    public function orderConfirmation()
    {
        return view('order-confirmation');
    }
}
