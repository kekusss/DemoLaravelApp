<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class Parser
 * @package App\Http\Controllers
 */
class Parser extends Controller
{
    /**
     * Retrieves and parses data retrieved from the API on the object
     *
     * @param $endpoint
     * @return Product
     */
    public static function parseToProductObject($endpoint)
    {
        $jsonArray = json_decode(file_get_contents($endpoint), true);

        $product = new Product();

        $product->id = $jsonArray[0]['id'];
        $product->name = $jsonArray[0]['name'];
        $product->description = $jsonArray[0]['description'];
        $product->image_url = $jsonArray[0]['image_url'];
        $product->ingredients = self::getIngredients($jsonArray[0]['ingredients']);

        return $product;
    }

    /**
     * retrieves and parses data retrieved from the API to the Array of objects
     *
     * @param $endpoint
     * @return array
     */
    public static function parseToProductsObjectsArray($endpoint)
    {
        $jsonArray = json_decode(file_get_contents($endpoint), true);

        $currentUserId = Auth::user()->getAuthIdentifier();

        $favoriteProductsIds = DB::table('favorites')->where('user_id', '=', $currentUserId)->get('product_id')->toArray();

        foreach ($favoriteProductsIds as $key => $item){
            $favoriteProductsIds[$key] = $item->product_id;
        }

        $products = [];

        foreach ($jsonArray as $item)
        {
            $product = new Product();

            $product->id = $item['id'];
            $product->name = $item['name'];
            $product->description = $item['description'];
            $product->image_url = $item['image_url'];
            $product->isFavorite = in_array($product->id, $favoriteProductsIds);
            $product->ingredients = self::getIngredients($item['ingredients']);

            $products[] = $product;
        }

        return $products;
    }

    /**
     * returns a list of ingredients
     *
     * @param array $combined
     * @return array
     */
    private static function getIngredients(array $combined){
        $ingredients = [];

        foreach ($combined['malt'] as $item){
            $ingredients[] = $item['name'];
        }

        foreach ($combined['hops'] as $item){
            $ingredients[] = $item['name'];
        }

        $ingredients[] = $combined['yeast'];

        return $ingredients;
    }

}
