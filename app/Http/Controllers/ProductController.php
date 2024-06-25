<?php

namespace App\Http\Controllers;

// import model product
use App\Models\Product;

// import return type view
use Illuminate\View\View;

// import return tyoe redurectResponse
use Illuminate\Http\RedirectResponse;

// import http request
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // index
    public function index() : View {
        // get all product
        $products = Product::latest()->paginate(10);

        // render view with products
        return view('products.index', compact('products'));
    }

    // create
    public function create() : View {
        return view('products.create');
    }
    
    // store
    public function store(Request $request): RedirectResponse {
        // validate form
        $request->validate([
            'image'         =>  'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'         =>  'required|min:5',
            'description'   =>  'required|min:10',
            'price'         =>  'required|numeric',
            'stock'         =>  'required|numeric'
        ]);

        // upload image
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        //create product
        Product::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock
        ]);

        // redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data saved successfully!']);
    }

    // show
    public function show(string $id) : View {
        // get product by ID
        $product = Product::findOrFail($id);

        // render view with product
        return view('products.show', compact('product'));
    }

    // edit
    public function edit(string $id) : View {
        // get product by ID
        $product = Product::findOrFail($id);

        // render view with product
        return view('products.edit', compact('product'));
    }
}
