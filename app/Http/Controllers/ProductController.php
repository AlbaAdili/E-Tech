<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

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
    
        if ($validator->fails())
        {
            return redirect()->route('product.index')->withErrors($validator);
        }
    
        $originalFileName = null;

        if ($request->hasFile('image')) {
            $originalFileName = $request->file('image')->getClientOriginalName();
            $imagePath = $request->file('image')->storeAs('public/images', $originalFileName);
        }
    
        Product::create([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'image' => 'images/' . $originalFileName,
        ]);
    
        return redirect()->route('product.index')->with('success', 'Inserted Product');
    }      

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
