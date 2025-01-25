@extends('layouts.app')

@section('content')
    <div class="login-page">
        <div class="container-fluid">
            <div class="row h-100">
                <div class="col-md-6 left-side">
                    <h1><i class="bi bi-handbag  icon"></i>SIMS Web App</h1>
                    <h3>
                    Masuk atau buat akun untuk memulai
                    </h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-3">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Masukkan email Anda" required autofocus>
                        </div>
                        <div class="mb-3">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Masukkan password Anda" required>
                        </div>
                        <button class="btn btn-custom" type="submit">Masuk</button>
                    </form>
                </div>
                <div class="col-md-6 right-side">
                    <img alt="3D illustration of a person walking with geometric shapes around them" height="600" src="{{ asset('CMS_Assets/Frame 98699.png') }}" width="600"/>
                </div>
            </div>
        </div>
    </div>
@endsection