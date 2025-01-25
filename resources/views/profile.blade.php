@extends('layouts.head-admin')

@section('content')
    <div class="d-flex align-items-center mb-4">
        <img alt="Profile picture of Kristanto Wibowo" height="100" src="{{ asset('CMS_Assets/Frame 98700.png') }}" width="100"/>
        <div class="ms-3">
        <h2>
        {{$user->name}}
        </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
        <label class="form-label" for="namaKandidat">
        Nama Kandidat
        </label>
        <input class="form-control" id="namaKandidat" readonly="" type="text" value="{{$user->name}}"/>
        </div>
        <div class="col-md-6 mb-3">
        <label class="form-label" for="posisiKandidat">
        Posisi Kandidat
        </label>
        <input class="form-control" id="posisiKandidat" readonly="" type="text" value="{{$user->role}}"/>
        </div>
    </div>
@endsection