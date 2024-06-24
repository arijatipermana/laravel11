<?php

namespace App\Http\Controllers;

// import model product
use App\Models\Product;

// import return type view
use Illuminate\View\View;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() : View {
        $product = Product::latest()->paginate(10);

        return view('products.index', compact('products'));
    }
}
