@extends('layouts.app')

@section('content')
<div class="content-inner">



    <!-- Content area -->
    <div class="content pt-0">


        <div class="mb-3 pt-2 text-center">
            <h6 class="mb-0 font-weight-semibold">
                Áruk listája
            </h6>
            <span class="text-muted d-block">valami alcím</span>
        </div>
        <div class="row col-10 mx-auto">
        @if($products->isNotEmpty())
            @foreach($products as $product)
            <div class="col-md-4">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top"  style="height: 225px; width: 100%; display: block;" src="{{ $product->image }}" data-holder-rendered="true">
                <div class="card-body">
                    <h6>{{ $product->name }}</h6>
                  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                     
                      <a class=" btn btn-sm btn-outline-primary" href="{{ url('products/'. $product->id) }}">
                    Részletek
                         </a>
                   
                      
                      <a class=" btn btn-sm btn-outline-success" href="{{ url('addToCart', ['id' => $product->id]) }}">
                    Kosárba
                         </a>
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            <div class="mx-auto">
              {{ $products->links() }}
            </div>
        @else
        <div>
          <h2>
            Nem található ilyen termék
          </h2>
        </div>
        @endif
        </div>
    </div>
</div>

<!-- /content area -->




@endsection