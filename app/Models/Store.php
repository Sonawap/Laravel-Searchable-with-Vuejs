<?php

namespace App\Models;

use App\Models\Product;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model implements Searchable
{
    use HasFactory;

    public function getSearchResult(): SearchResult
    {
        $url = route('store.show', $this->id);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->name,
            $url
        );
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}
