@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
<div class="container" id="home">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="headerText">
                Lista produktów
            </div>


            <div class="products col-md-12">
                <div class="row">
                @foreach($products as $product)
                    <div class="productCard col-md-4">


                        <div class="text-right favorite">
                            <a>
                                @if($product->isFavorite)
                                    <form action="{{ route('deleteFromFavorites', $product->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onclick="return confirm('Czy na pewno chcesz usunąć produkt z listy ulubionych?');" class="btn favorite">
                                            <i class="fa fa-star fa-lg" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('addToFavorites') }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <input type="hidden" value="{{ $product->id }}" name="id">
                                        <button type="submit" class="btn">
                                            <i class="fa fa-star  fa-lg" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                @endif
                            </a>
                        </div>


                        <div class="productName">
                            {{ $product->name }}
                        </div>


                        <div class="productDescription text-default text-left">
                            <p  onclick="readMore(this)">
                                {{ \Illuminate\Support\Str::limit($product->description , 150, '') }}
                                @if (strlen($product->description ) > 100)
                                    <span class="dots">...</span>
                                    <span class="more">{{ substr($product->description , 100) }}</span>
                                    <span class="button"> Więcej </span>
                                @endif
                            </p>
                        </div>


                        <div class="productIngredients text-default text-left">
                            <ul>
                                <?php $i=0; ?>

                                @foreach($product->ingredients as $ingredient)
                                    <?php
                                        if($i<5){
                                            echo "<li>".$ingredient."</li>";
                                        }
                                        else{
                                            echo "<li class='more'>".$ingredient."</li>";
                                        }
                                        $i++;
                                    ?>
                                @endforeach

                                @if(count($product->ingredients) > 5)
                                    <span class="button" onclick="getMoreIngredients(this)"> Więcej </span>
                                @endif
                            </ul>
                        </div>


                        <div class="productImage">
                            <img height="200px" src="{{ $product->image_url }}"></img>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>


            <nav class="justify-content-center">
                <ul class="pagination justify-content-center">
                    @if($page!=1)
                        <li class="page-item"><a class="page-link" href="{{ route('home',$page-1) }}">{{ $page-1 }}</a></li>
                    @endif
                    <li class="page-item"><a class="page-link font-weight-bolder" href="">{{ $page }}</a></li>
                    @if($hasNextPage)
                        <li class="page-item"><a class="page-link" href="{{ route('home',$page+1) }}">{{ $page+1 }}</a></li>
                    @endif
                    @if($page==1)
                        <li class="page-item"><a class="page-link" href="{{ route('home',$page+2) }}">{{ $page+2 }}</a></li>
                    @endif
                        <li class="page-item"><a class="page-link" href="#">... </a></li>
                        <li class="page-item"><a class="page-link font-weight-bolder" href="{{ route('home',$page+1) }}">&nbsp ></a></li>
                </ul>
            </nav>


            <div class="text-center" id="logo">
                <img class="logo" src="{{ asset('images/logo.png') }}" alt="Grupa Visit Logo"/>
            </div>


        </div>
    </div>
</div>

@endsection
