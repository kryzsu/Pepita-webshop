@extends('layouts.app')

@section('content')

<div class="container">
    <h1>{{ $product->name}}</h1>
    <div class="row">
        <div class="col-8">
            <div class="bg-light">
                <h3 class="col">ár:{{ $product->price}} Ft</h3>
                <h6>leírás:</h6>
                <p>
                    {{ $product->description}}
                </p>
                <form class="col-auto" action="/products/" method="POST">
                    @csrf
                    <div class="btn btn-primary">
                        vásárlás
                    </div>
                </form>

            </div>
        </div>
        <div class="col-4">
            <img src="{{ $product->image }}" alt="">
        </div>
    </div>
@endsection