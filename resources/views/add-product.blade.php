@extends('layouts.head-admin')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Daftar Produk</li>
            <li aria-current="page" class="breadcrumb-item active">Tambah Produk</li>
        </ol>
    </nav>
    <h4>Tambah Produk</h4>
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label class="form-label" for="kategori">Kategori</label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="kategori" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="namaBarang">Nama Barang</label>
                <input class="form-control @error('name') is-invalid @enderror" id="namaBarang" name="name" placeholder="Masukan nama barang" type="text" value="{{ old('name') }}" />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="form-label" for="hargaBeli">Harga Beli</label>
                <input class="form-control @error('purchase_price') is-invalid @enderror" id="hargaBeli" name="purchase_price" type="text" placeholder="Masukan harga barang" value="{{ old('purchase_price') }}" oninput="hitungHargaJual()" />
                @error('purchase_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="hargaJual">Harga Jual*</label>
                <input class="form-control @error('sale_price') is-invalid @enderror" id="hargaJual" name="sale_price" type="text" placeholder="Harga Jual Barang" value="{{ old('sale_price') }}" readonly />
                @error('sale_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label class="form-label" for="stokBarang">Stok Barang</label>
                <input class="form-control @error('stock') is-invalid @enderror" id="stokBarang" name="stock" placeholder="Masukan jumlah stok barang" type="text" value="{{ old('stock') }}" />
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="imageUpload">Upload Gambar (Format yang diizinkan: JPG/PNG, ukuran maksimal 100KB)</label>
            <input class="form-control @error('image') is-invalid @enderror" id="imageUpload" name="image" type="file" accept=".jpg, .jpeg, .png" onchange="validateAndDisplayImage()" />
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Container untuk menampilkan preview gambar -->
        <div id="imagePreviewContainer" style="display: none;">
            <img id="imagePreview" src="" alt="Image Preview" style="max-width: 100%; height: auto;" />
        </div>

        <!-- Pesan error yang akan ditampilkan jika validasi gagal -->
        <div id="error-message" style="color: red; display: none;"></div>
        
        <div class="d-flex justify-content-end">
            <a class="btn btn-outline-primary me-2" href="{{ route('product.index') }}">Batalkan</a>
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>
@endsection
