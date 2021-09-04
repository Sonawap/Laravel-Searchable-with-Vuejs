<?php

namespace App\Http\Controllers\API;

use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Http\Controllers\Controller;
use Spatie\Searchable\ModelSearchAspect;

class SearchController extends Controller
{
    public function search(Request $request){
        $this->validate($request, [
            's' => 'required'
        ]);

        $searchResults = (new Search())
            ->registerModel(Category::class, 'name', 'description')
            ->registerModel(Store::class,
                function(ModelSearchAspect $modelSearchAspect) {
                    $modelSearchAspect
                        ->addSearchableAttribute('name')
                        ->addSearchableAttribute('description')
                        ->with('category');
                })
            ->registerModel(Product::class,
                function(ModelSearchAspect $modelSearchAspect) {
                    $modelSearchAspect
                        ->addSearchableAttribute('name')
                        ->addSearchableAttribute('description')
                        ->with('category');
                })

            ->perform($request->get('s'));

        return response()->json([
            'results' => $searchResults->groupBy('type'),
            'total_result_count' => $searchResults->count()
        ], 200);
    }
}
