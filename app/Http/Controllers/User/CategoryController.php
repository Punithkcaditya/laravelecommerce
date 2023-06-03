<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductItem;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //TODO : ADD Validator when item quantity is not available

    public function index(Request $request)
    {

    }

    public function create()
    {

    }


    public function store(Request $request)
    {



    }

    public function show($id)
    {

        $category = Category::find($id);
        $products = Product::with('productImages','productItems.productItemFeatures')->where('category_id',$id)->paginate(10);
        $categories = Category::with('subcategories')->get();
        // dd($categories);
        return view('user.categories.show-category-products')->with([
            'category_name'=>$category,
            'category_products'=>$products,
            'categories'=>$categories,

        ]);

    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {

    }


    public function destroy(Request $request)
    {



    }

}
