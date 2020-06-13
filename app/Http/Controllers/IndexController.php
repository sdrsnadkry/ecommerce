<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Banners;
use App\Brand;

class Indexcontroller extends Controller
{
    //
    public function index(){
        //for product
        $productsAll = Product::inRandomOrder()->where('status',1)->where('feature_item',1)->paginate(6);
        //for categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        //for banners
        $banners = Banners::orderBy('title','ASC')->where('status',1)->get();
        //show small banners
        $showBanner = Product::inRandomOrder()->where('status',1)->where('show_banner',1)->get();
        //show all brands
        $brands = Brand::orderBy('name','ASC')->where('status',1)->get();
        

        return view('index')->with(compact('productsAll','categories','banners','showBanner','brands'));
    }
}
