<?php

namespace App\Models;

use App\Models\Store;
use App\Models\Product;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model implements Searchable
{
    use HasFactory;

    public function getSearchResult(): SearchResult
    {
        $url = route('category.show', $this->id);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }

    public function store(){
        return $this->hasMany(Store::class, 'category');
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}
