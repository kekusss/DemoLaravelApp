<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\JsonDecoder;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard with list of products.
     *
     * @param int $page
     * @return Renderable
     */
    public function index($page = 1)
    {
        $endpoint = "https://api.punkapi.com/v2/beers?page=$page&per_page=5";
        $products = Parser::parseToProductsObjectsArray($endpoint);

        $nextPage = json_decode(file_get_contents("https://api.punkapi.com/v2/beers?page=".($page+1)."&per_page=5"),true);
        $hasNextPage = ! empty($nextPage);

        return view('home', ['products' => $products, 'hasNextPage' => $hasNextPage, 'page' => $page]);
    }

    /**
     * adds product to the list of favorites
     *
     * @return Renderable
     */
    public function addToFavorites(){
        $productId = \request('id');
        $userId = Auth::user()->getAuthIdentifier();

        if($this->isProductFavorite($productId, $userId)){
            return back();
        }

        DB::table('favorites')->insert([
            'user_id' =>  $userId,
            'product_id' => $productId
        ]);

        return  back()->with('message','Dodano do ulubionych');
    }

    /**
     * checks if the product belongs to favorites
     *
     * @param $productId
     * @param $userId
     * @return bool
     */
    private function isProductFavorite($productId, $userId){

        return DB::table('favorites')
                ->where([
                    ['user_id','=', $userId],
                    ['product_id', '=', $productId]
                ])->exists();
    }
}
