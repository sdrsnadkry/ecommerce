<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use Auth;
use DB;

class Product extends Model
{
    //
    public function attributes(){
        return $this->hasMany('App\ProductsAttribute','product_id');
    }

    public static function cartCount(){
        if (Auth::check()) {
            // "logged in";
            $user_email = Auth::user()->email;
            $cartCount = DB::table('cart')->where('user_email',$user_email)->sum('quantity');
        }else{
            // "Not logged in";
            $session_id = Session::get('session_id');
            $cartCount = DB::table('cart')->where('session_id',$session_id)->sum('quantity');

        }
        return $cartCount;
    }
    public static function productCount($cat_id){
        $catCount = Product::where(['category_id'=>$cat_id, 'status'=>1])->count();

        return $catCount;
    }
}
