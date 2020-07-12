@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <div class="container" id="home">
        <div class="row justify-content-center">
            @isset($products[0])
            <div class="col-md-8">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif


                <div class="headerText">
                    Ulubione
                </div>


                <div class="mailForm">
                    <form action="{{ route('sendMailWithFavorites') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <span>Wyślij listę ulubionych na maila</span><input type="email" placeholder="Wprowadź adres email" value="{{ $currentUserEmail }}" name="email">
                        <input type="submit" class="btn " value="Wyślij">
                    </form>
                </div>

                <div class="products col-md-12">
                    <div class="row">

                        @for ($i = $page*5-5; $i < $page*5; $i++)
                            @isset($products[$i])
                                <div class="productCard col-md-4">


                                    <div class="text-right favorite">
                                        <a>
                                            <form action="{{ route('deleteFromFavorites', $products[$i]->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" onclick="return confirm('Czy na pewno chcesz usunąć produkt z listy ulubionych?');" class="btn">
                                                    <i class="fa fa-trash fa-lg" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </a>
                                    </div>


                                    <div class="productName">
                                        {{ $products[$i]->name }}
                                    </div>


                                    <div class="productDescription text-default text-left">
                                        <p  onclick="readMore(this)">
                                            {{ \Illuminate\Support\Str::limit($products[$i]->description , 150, '') }}
                                            @if (strlen($products[$i]->description) > 100)
                                                <span class="dots">...</span>
                                                <span class="more">{{ substr($products[$i]->description, 100) }}</span>
                                                <span class="button"> Więcej </span>
                                            @endif
                                        </p>
                                    </div>


                                    <div class="productIngredients text-default text-left">
                                        <ul>

                                            <?php $j=0; ?>
                                            @foreach($products[$i]->ingredients as $ingredient)
                                                <?php
                                                if($j<5){
                                                    echo "<li>".$ingredient."</li>";
                                                }
                                                else{
                                                    echo "<li class='more'>".$ingredient."</li>";
                                                }
                                                $j++;
                                                ?>
                                            @endforeach
                                            @if(count($products[$i]->ingredients) > 5)
                                                <span class="button" onclick="getMoreIngredients(this)"> Więcej </span>
                                            @endif
                                        </ul>
                                    </div>


                                    <div class="productImage">
                                        <img height="200px" src="{{ $products[$i]->image_url }}"></img>
                                    </div>
                                </div>
                            @endisset
                        @endfor
                </div>
            </div>


            <nav class="justify-content-center">
                <ul class="pagination justify-content-center">
                    @if($page!=1)
                        <li class="page-item"><a class="page-link" href="{{ route('favorites',$page-1) }}">{{ $page-1 }}</a></li>
                    @endif
                    <li class="page-item"><a class="page-link font-weight-bolder" href="">{{ $page }}</a></li>
                    @if($hasNextPage)
                        <li class="page-item"><a class="page-link" href="{{ route('favorites',$page+1) }}">{{ $page+1 }}</a></li>
                    @endif
                    @if($page==1 && count($products) > 10)
                        <li class="page-item"><a class="page-link" href="{{ route('favorites',$page+2) }}">{{ $page+2 }}</a></li>
                    @endif
                    <li class="page-item"><a class="page-link" href="#">... </a></li>
                    <li class="page-item"><a class="page-link font-weight-bolder" href="{{ route('favorites',$page+1) }}">&nbsp ></a></li>
                </ul>
            </nav>

            @else
                    <div class="col-md-12">
                        <div class="col-md-8 offset-2 alert alert-danger">
                            Brak ulubionych produktów
                        </div>
                    </div>
            @endisset



            <div class="text-center" id="logo">
                <img class="logo" src="{{ asset('images/logo.png') }}" alt="Grupa Visit Logo"/>
            </div>
        </div>
    </div>

@endsection
