@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Kosár</h1>
    @if($products)
    <div class="row">
        <div class="col-10">

       
            @foreach($products as $product)
            <div class="row mb-2 bg-light">
                <h6 class="col">{{ $product['item']['name'] }}</h6>
                <span class="col-auto"> Egységár:</span>
                <h6 class="col-auto"> {{ $product['item']['price']}}</h6>
                <span class="col-auto">mennyiség:</span>
                <form class="col-auto" action="/products/" method="POST">
                    @csrf
                    <input value="{{ $product['qty'] }}" type="number"/>
                </form>
                <span class="col-auto"> Részösszeg:</span>
                <h6 class="col-auto"> {{ $product['price']}}</h6>

                <form class="col-auto" action="{{ route('destroy', $product['item']['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        törlés
                    </button>
                </form>

            </div>
            @endforeach
      

        </div>
        <div class="col-2">
            <h3> Rendelés összegzése</h3>
            <h6>Termék mennyisége:</h6>
            <h6>Végösszeg: {{ $totalPrice }}</h6>
            <form class="col-auto"  method="POST">
                    @csrf
                   
                    <a href="{{ route('checkout') }}" class="btn btn-success">
                        Fizetés
                    </a>
            </form>
        </div>
    </div>
    @else
    <h2>Jelenleg nincs termék a kosárban</h2> 
    @endif
</div>

@endsection