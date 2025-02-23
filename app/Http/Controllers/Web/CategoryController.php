<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
        public function search(Request $request): JsonResponse
        {
            $categories = [];
            if($request->has('q')){
                $search = $request->q;
                $categories = Category::select("id", "name")
                    ->where('name', 'LIKE', "%$search%")
                    ->get();
            }
            return response()->json($categories);
        }
}
