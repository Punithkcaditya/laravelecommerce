<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
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

        $sub_category = SubCategory::find($id);
        $products = Product::with('productImages','productItems.productItemFeatures')->where('sub_category_id',$id)->paginate(10);
        $categories = Category::with('subcategories')->get();

        return view('user.sub-categories.show-sub-category-products')->with([
            'sub_category'=>$sub_category,
            'products'=>$products,
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
