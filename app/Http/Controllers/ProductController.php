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
    public function create() : Vies {
        return view('products.create');
    }
}
