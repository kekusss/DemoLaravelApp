<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Mail\FavoritesMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * Class FavoritesController
 * @package App\Http\Controllers
 */
class FavoritesController extends Controller
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
     * Create Favorites View
     *
     * @param int $page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($page = 1)
    {
        $currentUserId = Auth::user()->getAuthIdentifier();

        $currentUserMail = DB::table('Users')->where('id', '=', $currentUserId)->get('email')->toArray();
        $currentUserMail = $currentUserMail[0]->email;

        $products = $this->getProductsList();

        $nextPage = count($products) - $page*5 > 0;

        return view('favorites', ['products' => $products, 'page'=> $page, 'hasNextPage' => $nextPage, 'currentUserEmail' => $currentUserMail] );
    }

    /**
     * Generates favorites products list
     *
     * @return array
     */
    private function getProductsList()
    {
        $currentUserId = Auth::user()->getAuthIdentifier();

        $productsIds = DB::table('favorites')->where('user_id', '=', $currentUserId)->get('product_id');

        $products = [];

        foreach ($productsIds->toArray() as $productId) {
            $endpoint = "https://api.punkapi.com/v2/beers/" . $productId->product_id;
            $products[] = Parser::parseToProductObject($endpoint);
        }

        return $products;
    }

    /**
     * Sends an email with a list of favorite products
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send()
    {
        $mailTo = \request('email');

        $favorites = $this->getProductsList();

        Mail::to($mailTo)->send(new FavoritesMail($favorites));

        return back()->with('message','Wysłano maila na adres: ' . $mailTo);
    }

    /**
     * Removes the product from the list of favorites
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        DB::table('favorites')->where('product_id','=',$id)->delete();

        return back()->with('message','Usunięto produkt z listy');
    }

}
