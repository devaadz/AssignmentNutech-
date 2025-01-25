<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProductsExport;
use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = product::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        $message = null; // Default tidak ada pesan
         $products = $query->paginate(10);
        $categories = category::all();

        return view('dashboard', compact('products', 'categories','message'));
    }

    // Show form for creating a new product
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products,name',
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,png|max:100',
            'category_id' => 'required|exists:categories,id'
        ]);
        // dd($request);
        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    // Show edit form for a product
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('edit-product', compact('product', 'categories'));
    }

    // Update a product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|unique:products,name,' . $product->id,
            'purchase_price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png|max:100',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'purchase_price' => $request->purchase_price,
            'sale_price' => $request->purchase_price * 1.3,
            'stock' => $request->stock,
            'image' => $product->image,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    // Delete a product
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }

    // Export products to Excel
    public function export(Request $request)
    {
        return Excel::download(new ProductsExport($request->search, $request->category_id), 'products.xlsx');
    }
    public function addProduct()
    {
        // Ambil semua data dari tabel categories
        $categories = Category::all();

        // Kirim data categories ke view 'add-product'
        return view('add-product', ['categories' => $categories]);
    }
    public function filter(Request $request)
    {
        $query = Product::query();

        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }
        

        // $products = $query->get();

        // return response()->json($products);
        $products = $query->paginate(10);
        $categories = category::all();
        $message = null; // Default tidak ada pesan
        if ($products->isEmpty()) {
            $message = "Data tidak ditemukan sesuai filter yang diberikan.";
        }
    
        // Kirim data ke view
        return view('dashboard', compact('products', 'categories', 'message'));
    }
    

}
