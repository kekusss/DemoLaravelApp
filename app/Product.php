<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public int $id;
    public string $name;
    public string $image_url;
    public string $description;
    public array $ingredients;
    public bool $isFavorite;
}
