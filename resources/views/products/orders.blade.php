@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Megrendelt termékek</h1>

    <div class="row">
        <div class="col-10">


            @foreach($orders as $order)

            @foreach($order->cart->items as $item)
            <div class="row mb-2 bg-light">
                <h6 class="col">{{ $item['item']['name'] }}</h6>
                @if(auth()->user()->email == 'admin@admin.com')
                <span class="col-auto">megrendelő: </span>
                <h6 class="col-auto">{{ $order->name }}</h6>
                @endif
                <span class="col-auto"> Egységár:</span>
                <h6 class="col-auto"> {{ $item['item']['price']}}</h6>
                <span class="col-auto">mennyiség:</span>
                <form class="col-auto" action="/orders/" method="POST">
                    @csrf
                    <input value="{{ $item['qty'] }}" type="number" />
                </form>

            </div>
            
                @endforeach
                @if(auth()->user()->email == 'admin@admin.com')
                <form class="col-auto mb-3 text-center" action="{{ route('destroyOrder', $order->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        törlés
                    </button>
                </form>
                @endif
                @endforeach

           
        </div>
    </div>
</div>

@endsection