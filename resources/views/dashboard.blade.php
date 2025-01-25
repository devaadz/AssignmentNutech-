@extends('layouts.head-admin')

@section('content')
    <h3>Daftar Produk</h3>
    <div class="d-flex flex-wrap align-items-center mb-3 gap-3">
        <!-- Form Filter -->
        <form action="{{ route('filter') }}" method="POST" class="d-flex flex-wrap gap-3 align-items-center w-100">
            @csrf <!-- Token CSRF untuk keamanan -->

            <!-- Input untuk nama barang -->
            <div class="form-group flex-grow-1">
                <input 
                    type="text" 
                    class="form-control" 
                    id="namaBarang" 
                    name="name" 
                    placeholder="Masukkan nama barang" 
                    value="{{ old('name') }}" 
                />
            </div>

            <!-- Dropdown untuk kategori -->
            <div class="form-group">
                <select 
                    class="form-select" 
                    id="kategori" 
                    name="category_id">
                    <option value="">-- Semua Kategori --</option>
                    @foreach ($categories as $category)
                        <option 
                            value="{{ $category->id }}" 
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol submit -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>
        </form>

        <!-- Pesan jika data kosong -->
        @if($message)
            <div class="alert alert-warning flex-grow-1 w-100">
                {{ $message }}
            </div>
        @endif

        <!-- Tombol tambahan -->
        <div class="d-flex gap-2 ms-auto">
            <!-- Tombol Export Excel -->
            <a href="{{ route('export.products', ['search' => request()->search, 'category_id' => request()->category_id]) }}" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>

            <!-- Tombol Tambah Produk -->
            <a href="/add-product" class="btn btn-danger" target="_blank">
                <i class="fas fa-plus"></i> Tambah Produk
            </a>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Nama Produk</th>
                <th>Kategori Produk</th>
                <th>Harga Beli (Rp)</th>
                <th>Harga Jual (Rp)</th>
                <th>Stok Produk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img 
                        alt="{{ $product->name }}" 
                        height="40" 
                        src="{{ asset('storage/' . $product->image) }}"
                        width="40" 
                    />
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                <td>{{ number_format($product->sale_price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a class="text-primary" href="{{ route('product.edit', $product->id) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="text-danger" href="{{ route('product.destroy', $product->id) }}" onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-between">
        <div>Show {{ $products->firstItem() }} to {{ $products->lastItem() }} from {{ $products->total() }}</div>
        <nav>
            {{ $products->links() }}
        </nav>
    </div>
@endsection
