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
            $users = [];
            if($request->has('q')){
                $search = $request->q;
                $users = Category::select("id", "name","mobile",'email')->with('avatar')
                    ->where('name', 'LIKE', "%$search%")
                    ->orWhere('mobile', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->get();
            }
            return response()->json($users);
        }
}
