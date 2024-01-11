<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
}
