<?php

namespace App\Models;

use App\Models\Store;
use App\Models\Category;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements Searchable
{
    use HasFactory;

    public function getSearchResult(): SearchResult
    {
        $url = route('product.show', $this->id);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }
}
