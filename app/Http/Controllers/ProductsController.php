<?php

namespace App\Http\Controllers;
use DB;
use Auth;
Use Alert;
use Image;
use Session;
use App\User;
use App\Order;
use App\Country;
use App\Product;
use App\Category;
use Dompdf\Dompdf;
use App\OrdersProduct;
use App\ProductsImage;
use App\DeliveryAddress;
use App\ProductsAttribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Input;


class ProductsController extends Controller
{
    //
    public function addProduct(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            $product =  new Product;
            if(!empty($data['category_id'])){
                
                $product->category_id = $data['category_id'];
            }else{
                return redirect()->back()->with('flash_message_error','Please select a category for product');
            }
            
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            if(!empty($data['description'])){
                $product->description = $data['description'];
            }else{
                
                $product->description = '';
            }
            if(!empty($data['care'])){
                $product->care = $data['care'];
            }else{
                
                $product->care = '';
            }
            if (empty($data['status'])){
                $product->status = 0;
            }else{
                $product->status = 1;
            }
            if (empty($data['feature_item'])){
                $product->feature_item = 0;
            }else{
                $product->feature_item = 1;
            }
            if (empty($data['show_banner'])){
                $product->show_banner = 0;
            }else{
                $product->show_banner = 1;
            }
            $product->price = $data['price'];
            /********************code for image upload***************** */
            //  echo "<pre>"; print_r($data); die;
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                   $extension = $image_tmp->getClientOriginalExtension();
                   $filename = "Image-".date('Ymdhis').rand(0,999).'.'.$extension;
                   $large_image_path =   'images/backend_images/products/large/'.$filename;
                   $medium_image_path =   'images/backend_images/products/medium/'.$filename;
                   $banner_image_path =   'images/backend_images/products/banner/'.$filename;
                   $small_image_path =   'images/backend_images/products/small/'.$filename;
                   //resize images
                   Image::make($image_tmp)->save($large_image_path);
                   Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                   Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                   Image::make($image_tmp)->resize(800,570)->save($banner_image_path);
                   //store images name in product table
                   $product->image = $filename; 
                }
            } 
            //upload video
            if ($request->hasFile('video')) {
               $video_tmp = $request->file('video');
               $video_name = $video_tmp->getClientOriginalName();
               $video_path = 'videos/';
               $video_tmp->move($video_path,$video_name);
               $product->video = $video_name;

            }  
            // $product = json_decode(json_encode($product));
            // echo "<pre>"; print_r($product); die;
            $product->save();

            return redirect()->back()->with('flash_message_success','Product Added Successfully');
        }
        /*******************code to disaplay categories dropdown **************** */
        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value='' selected disabled >---</option>";
       
        
        foreach($categories as $cat){
            $categories_dropdown .= "<option disabled value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat){
                 $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp".$sub_cat->name."</option>";
                   /*******************code to disaplay categories dropdown **************** */
         
            }
        }
       
        

        return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }
    public function viewProducts(){
        $products = Product::orderby('id','DESC')->get();
        $products = json_decode(json_encode($products));
        foreach($products as $key=> $val){
            $category_name = Category::where(['id'=>$val->category_id])->first();
            $products[$key]->category_name = $category_name->name; 

        }
        // echo "<pre>"; print_r($products); die;
        return view('admin.products.view_products')->with(compact('products'));

    }
    public function editProduct(Request $request, $id=null ){
        if($request->isMethod('post')){
            $data = $request->all();
            /**code to update */
            if(empty($data['category_id'])){
                return redirect()->back()->with('flash_message_error','Please select a category for product');
            }      
            if($request->hasFile('image')){
                $updateImageDelete = $data['current_image'];
                // echo "<pre>";
                // print_r($data);die;
                if (!empty($updateImageDelete)) {
                    unlink(public_path().'/images/backend_images/products/large/'.$updateImageDelete);
                    unlink(public_path().'/images/backend_images/products/medium/'.$updateImageDelete);
                    unlink(public_path().'/images/backend_images/products/small/'.$updateImageDelete);
                    // unlink(public_path().'/images/backend_images/products/banner/'.$updateImageDelete);
                }
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                   $extension = $image_tmp->getClientOriginalExtension();
                   $filename = "Image-".date('Ymdhis').rand(0,999).'.'.$extension;
                   $large_image_path =   'images/backend_images/products/large/'.$filename;
                   $medium_image_path =   'images/backend_images/products/medium/'.$filename;
                   $small_image_path =   'images/backend_images/products/small/'.$filename;
                   $banner_image_path =   'images/backend_images/products/banner/'.$filename;
                   //resize images
                   Image::make($image_tmp)->save($large_image_path);
                   Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                   Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                   Image::make($image_tmp)->resize(800,570)->save($banner_image_path);
                   //store images name in product table
                }
            }
            else if (!empty($data['current_image'])){
                $filename = $data['current_image']; 
            }else{
                $filename = '';
            }
             //upload video
             if ($request->hasFile('video')) {
                
                 if (!empty($data['current_video'])) {
                     unlink('videos/'.$data['current_video']);
                    }
                $video_tmp = $request->file('video');
                $video_name = $video_tmp->getClientOriginalName();
                $video_path = 'videos/';
                $video_tmp->move($video_path,$video_name);
                $videoName = $video_name;
 
             } else if (!empty($data['current_video'])){
                $videoName = $data['current_video']; 
            }else{
                $videoName = '';
            } 


            if(empty($data['description'])){
                $data['description']='';
            }
            if(empty($data['care'])){
                $data['care']='';
            }
            if (empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }   
            if (empty($data['feature_item'])){
                $feature_item = 0;
            }else{
                $feature_item = 1;
            }  
            if (empty($data['show_banner'])){
                $show_banner = 0;
            }else{
                $show_banner = 1;
            }  
            Product::where(['id'=>$id])->update(['category_id'=>$data['category_id'],
                                                'product_name'=>$data['product_name'],
                                                'product_code'=>$data['product_code'],
                                                'product_color'=>$data['product_color'],
                                                'description'=>$data['description'],
                                                'care'=>$data['care'],
                                                'price'=>$data['price'],
                                                'image'=>$filename,
                                                'video'=>$videoName,
                                                'feature_item'=>$feature_item,
                                                'show_banner'=>$show_banner,
                                                'status'=>$status]);
            return redirect('/admin/view-products')->with('flash_message_success','Product was updated successfully.');
        }
        //code to get product details*************************************
        $productDetails = Product::where(['id'=>$id])->first();
         /*******************code to disaplay categories dropdown **************** */
         $categories = Category::where(['parent_id'=>0])->get();
         $categories_dropdown = "<option value='' selected disabled >---</option>";
         foreach($categories as $cat){
             if ($cat->id==$productDetails->category_id) {
                 $selected = "selected";
             }else{
                 $selected = '';
             }
             $categories_dropdown .= "<option disabled value='".$cat->id."'".$selected.">".$cat->name."</option>";
             $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
             foreach($sub_categories as $sub_cat){
                if ($sub_cat->id==$productDetails->category_id) {
                    $selected = "selected";
                }else{
                    $selected = '';
                }
                  $categories_dropdown .= "<option value='".$sub_cat->id."'".$selected.">&nbsp;--&nbsp".$sub_cat->name."</option>";
             }
         }
           /*******************code to disaplay categories dropdown **************** */
        return view('admin.products.edit_product')->with(compact('productDetails','categories_dropdown'));

    }
    // public function deleteProductImage(Request $request, $id=null){
    //     Product::where(['id'=>$id])->update(['image'=>'']);
    //     return redirect()->back()->with('flash_message_success','Product image deleted succesfully');

    // }
    public function deleteProduct(Request $request, $id=null){
        $datas = Product::where(['id'=>$id])->first();
        $delImage = $datas->image;        
        $success = Product::where(['id'=>$id])->delete();
        if($success){
            if (public_path().'/images/backend_images/products/large/'.$delImage) {
                unlink(public_path().'/images/backend_images/products/large/'.$delImage);
            }
            if (public_path().'/images/backend_images/products/medium/'.$delImage) {
                unlink(public_path().'/images/backend_images/products/medium/'.$delImage);
            }
            if (public_path().'/images/backend_images/products/small/'.$delImage) {
                unlink(public_path().'/images/backend_images/products/small/'.$delImage);
            }
        }
        return redirect()->back()->with('flash_message_success','Product deleted succssfully');
    }
    public function addAttributes(Request $request, $id = null){
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        // $productDetails = json_decode(json_encode($productDetails));
        // echo "<pre>";print_r($productDetails);die;

        if($request->isMethod('post')){
            $data = $request->all();
            foreach($data['sku'] as $key => $val){
                if(!empty($val)){
                    //Prevent duplicate SKU verify
                    $attrCountSKU = ProductsAttribute::where('sku',$val)->count();
                    if ($attrCountSKU>0) {
                        return redirect()->back()->with('flash_message_error', $sku = $val." already exists || Cannot have multiple SKU of same values.");
                    }
                    //Prevent duplicate Size verify
                    $attrCountSize = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if ($attrCountSize>0) {
                        return redirect()->back()->with('flash_message_error', $data['size'][$key]."size already exists || Cannot have multiple Size of same values");
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }

            }
            return redirect('admin/add-attributes/'.$id)->with('flash_message_success','Attributes has been added successfully');
        }
        return view('admin.products.add_attributes')->with(compact('productDetails'));

    }
    public function editAttributes(request $request, $id=null){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);die;
            foreach($data['idAttr'] as $key => $attr){
                //  echo "<pre>";
                // print_r($data);die;
                ProductsAttribute::where(['id'=>$data['idAttr'][$key]])->update(['size'=>$data['size'][$key],
                                                                                'price'=>$data['price'][$key],
                                                                                'stock'=>$data['stock'][$key],
                                                                                
                                                                                ]);
            }
            return redirect()->back()->with('flash_message_success','Products Attributes has been updated');
          
        }

    }
    public function deleteAttributes(Request $request, $id=null){
        ProductsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Attributes deleted succssfully');
    }
    public function addImages(Request $request, $id = null){
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        // $productDetails = json_decode(json_encode($productDetails));
        
        if($request->isMethod('post')){
            $data = $request->all();
            //    $data = json_decode(json_encode($data));

            //          echo "<pre>";print_r($data);die;
            if ($request->hasFile('image')) {
                $files = $request->file('image'); 
                foreach($files as $file){
                    //  echo "<pre>";print_r($files);die;
                    //upload images after resize
                    $image = new ProductsImage;
                    $extension = $file->getClientOriginalExtension();
                    $fileName = "Image-".rand(0,999).'.'.$extension;
                    $large_image_path = "images/backend_images/products/large/".$fileName;
                    $medium_image_path = "images/backend_images/products/medium/".$fileName;
                    $small_image_path = "images/backend_images/products/small/".$fileName;
                    Image::make($file)->save($large_image_path);
                    Image::make($file)->resize(600,600)->save($medium_image_path);
                    Image::make($file)->resize(300,300)->save($small_image_path);
                    $image->image = $fileName;
                  
                    $image->product_id = $data['product_id'];
                    $image->save();

                }
               
            }
            
            return redirect('admin/add-images/'.$id)->with('flash_message_success','Product Images added successfully');
        }


        $productImages = ProductsImage::where(['product_id'=>$id])->get();

        return view('admin.products.add_images')->with(compact('productDetails','productImages'));

    }
    public function deleteAltImages(Request $request, $id=null){
        $productImage = ProductsImage::where(['id'=>$id])->first();
        $delImage = $productImage->image;
        // echo "<pre>";
        // print_r($delImage);die;
             $success = ProductsImage::where(['id'=>$id])->delete();
             if($success){
                 if (public_path().'/images/backend_images/products/large/'.$delImage) {
                     unlink(public_path().'/images/backend_images/products/large/'.$delImage);
                 }
                 if (public_path().'/images/backend_images/products/medium/'.$delImage) {
                     unlink(public_path().'/images/backend_images/products/medium/'.$delImage);
                 }
                 if (public_path().'/images/backend_images/products/small/'.$delImage) {
                     unlink(public_path().'/images/backend_images/products/small/'.$delImage);
                 }
             }
             return redirect()->back()->with('flash_message_success','Products Image deleted succssfully');

    }
    public function products($url=null){
        //check 404 for invalid url
        $countCategory =  Category::where(['url'=>$url,'status'=>1])->count();
        if ($countCategory==0) {
            abort(404);
        }
        //get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $categoryDetails = Category::where(['url'=>$url])->first();
        if($categoryDetails->parent_id == 0){
            //if url is main category url
            $subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get(); 
            //to fetch sub category ids like 3,6,9 in array
            foreach($subCategories as $key=> $subcat){
                $cat_ids[] = $subcat->id;
            }
            $productsAll = Product::whereIn('category_id',$cat_ids)->where('status',1);
            //for breadcumbs
            $breadcrumb = "<a href='/'>Home  </a> <i class='fa fa-angle-right' ></i> <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a>";

        }else{
            //if url is sub category url
            $productsAll = Product::where(['category_id'=>$categoryDetails->id])->where('status',1);

            $mainCategory = Category::where('id',$categoryDetails->parent_id)->first();

            $breadcrumb = "<a href='/'>Home  </a> <i class='fa fa-angle-right' ></i> <a href='".$mainCategory->url."'>".$mainCategory->name." </a> <i class='fa fa-angle-right' ></i>    <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a>";
        }
        //for filter
        if (!empty($_GET['color'])) {
            $colorArray = explode('-',$_GET['color']);
            $productsAll = $productsAll->whereIn('product_color',$colorArray);
        }
        if (!empty($_GET['size'])) {
            $sizeArray = explode('-',$_GET['size']);

            $productsAll = $productsAll->join('products_attributes','products_attributes.product_id','=','products.id')
                                        ->select('products.*','products_attributes.product_id','products_attributes.size')
                                        ->groupBy('products_attributes.product_id')
                                        ->whereIn('products_attributes.size',$sizeArray);

        }

        $productsAll = $productsAll->paginate(6);
        //get all colors
        // $colorArray = array('black','blue','brown','green','orange','pink','purple','silver','white');
        $colorArray = Product::select('product_color')->groupBy('product_color')->get();
        $colorArray = array_flatten(json_decode(json_encode($colorArray),true));
        //get all sizes from attributes
        $sizesArray = ProductsAttribute::select('size')->groupBy('size')->get();
        $sizesArray = array_flatten(json_decode(json_encode($sizesArray),true));

        // echo "<pre>";print_r($colorArray);die;

        return view('products.listing')->with(compact('categoryDetails','productsAll','categories','url','colorArray','sizesArray','breadcrumb'));
        
    }
    public function product($id=null){
        //show 404 if product is disabled
        $productsCount = Product::where(['id'=>$id, 'status'=>1])->count();
        if ($productsCount == 0) {
            abort(404);
        }
        //get product details
        $productDetails = product::with('attributes')->where('id',$id)->first();
          //get all categories and sub categories
          $categories = Category::with('categories')->where(['parent_id'=>0])->get();
          //get ptoducts alternate images
          $productAltImages = ProductsImage::where('product_id',$id)->get();
          //stock availability
          $total_stock = ProductsAttribute::where('product_id',$id)->sum('stock');
          //recommended products
          $relatedProducts = Product::where('id','!=',$id)->where('status',1)->where(['category_id'=>$productDetails->category_id])->get();

          /***********breadcrumb code */
            $categories = Category::with('categories')->where(['parent_id'=>0])->get();
            $categoryDetails = Category::where('id',$productDetails->category_id)->first();
            if($categoryDetails->parent_id == 0){  
                //for breadcumbs
                $breadcrumb = "<a href='/'>Home  </a> <i class='fa fa-angle-right' ></i> <a href='".$categoryDetails->url."'>".$categoryDetails->name."</a> <i class='fa fa-angle-right' ></i> ".$productDetails->product_name;

            }else{
                $mainCategory = Category::where('id',$categoryDetails->parent_id)->first();

                $breadcrumb = "<a href='/'>Home  </a> <i class='fa fa-angle-right' ></i> <a href='/products/".$mainCategory->url."'>".$mainCategory->name." </a> <i class='fa fa-angle-right' ></i> <a href='/products/".$categoryDetails->url."'>".$categoryDetails->name."</a> <i class='fa fa-angle-right' ></i> ".$productDetails->product_name;
            }

          /***********breadcrumb code */



          

        return view('products.detail')->with(compact('productDetails','categories','productAltImages','total_stock','relatedProducts','breadcrumb'));
    }
    public function getProductPrice(Request $request){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $proArr = explode("-",$data['idSize']);
        // echo $proArr[0];echo $proArr[1];die;
        $proAttr = ProductsAttribute::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
        echo $proAttr->price;
        echo "#";
        echo $proAttr->stock;


    }
    public function addToCart(Request $request){
        $data = $request->all(); 
        //product add to cart stock isuue solved
        $product_size = explode("-",$data['size']);
        $getProductStock = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$product_size[1]])->first();
        if ($getProductStock->stock<$data['quantity'] && $product_size[1] == '0') {
            return redirect()->back()->with('flash_message_error','Required Quantity Of Product Is Not Available');          
        }

        if(empty(Auth::user()->email)){
            $data['user_email'] = "";
        }else{
            $data['user_email'] = Auth::user()->email;
        }
        
        $session_id = Session::get('session_id');
        if(empty($session_id)){
            $session_id = Str::random(30);
            Session::put('session_id', $session_id);
        }
        $sizeArr = explode("-",$data['size']);
        $countProducts = DB::table('cart')->where(['product_id'=>$data['product_id'],
                                                    'product_color' => $data['product_color'],
                                                    'size' => $sizeArr[1],
                                                    'session_id' => $session_id,
                                                    ])->count();
        if ($countProducts>0) {
            return redirect()->back()->with('flash_message_error','Product Already Exists In Cart');   
        }else{
            $getSKU = ProductsAttribute::select('sku')->where(['product_id'=>$data['product_id'],'size'=>$sizeArr[1]])->first();
        // echo "<pre>";print_r($data);die;
            DB::table('cart')->insert(['product_id'=>$data['product_id'],
                                    'product_name' => $data['product_name'],
                                    'product_code' => $getSKU->sku,
                                    'product_color' => $data['product_color'],
                                    'size' => $sizeArr[1],
                                    'price' => $data['price'],
                                    'quantity' => $data['quantity'],
                                    'user_email' => $data['user_email'],
                                    'session_id' => $session_id,
                                ]);
        }                                                             
        return redirect('/cart')->with('flash_message_success','Product Has Been Added To Cart');
    }
    public function cart(){
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();

        }else{
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        }

        foreach($userCart as $key=> $product){
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        //  echo "<pre>";print_r($userCart);

        return view('products.cart')->with(compact('userCart'));
    }
    public function deleteCartProduct($id=null){
        //    echo "<pre>";print_r($id);
        $success =DB::table('cart')->where('product_id',$id)->delete();

        return redirect('/cart')->with('flash_message_success','Product Deleted Successfully From Cart');


    }
    public function updateCartQuantity($id = null, $quantity = null){
        $getCartDetails = DB::table('cart')->where('id',$id)->first();
        $getAttributeStock =  ProductsAttribute::where('sku',$getCartDetails->product_code)->first(); 
        // echo $getAttributeStock->stock; echo "---"; 
        $updated_Quantity = $getCartDetails->quantity+$quantity;
        // die;
        if($getAttributeStock->stock >= $updated_Quantity){
            DB::table('cart')->where('id', $id)->increment('quantity', $quantity);
            return redirect('/cart')->with('flash_message_success', 'Product Quantity has been updated Successfullt');
        }else{
            return redirect('/cart')->with('flash_message_error', 'Required Quantity Of Product is not Available ');
        }
       
    }
    public function checkout(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);
        $countries = Country::get();
        // echo "<pre>";print_r($user_email);die;

        //check if shipping address exisites
        $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
        $shippingDetails = array();
        if($shippingCount>0){
            $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        }

        //update cart table with user email
        $session_id = Session::get('session_id');
        DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);

            //this is done after entering datas in checkout pages
            if ($request->isMethod('post')) {
                $data = $request->all();
                if (empty($data['billing_name']) || empty($data['billing_address']) ||
                empty($data['billing_city']) || empty($data['billing_state']) ||  
                empty($data['billing_country']) || empty($data['billing_mobile'])||
                empty($data['shipping_name']) || empty($data['shipping_address']) ||
                empty($data['shipping_city']) || empty($data['shipping_state']) ||  
                empty($data['shipping_country']) || empty($data['shipping_mobile'])){
                    
                    return redirect()->back()->with('flash_message_error','All the fields are required (except Pincode) for Checkout');
                }
                //update user details
                User::where('id',$user_id)->update([
                                                    'name'=>$data['billing_name'],'address'=>$data['billing_address'],
                                                    'city'=>$data['billing_city'],'state'=>$data['billing_state'],
                                                    'country'=>$data['billing_country'],'mobile'=>$data['billing_mobile'],
                                                    'pincode'=>$data['billing_pincode']
                                                ]);
                if($shippingCount>0){
                    //update shipping address
                    DeliveryAddress::where('user_id',$user_id)->update([
                                                                'name'=>$data['shipping_name'],'address'=>$data['shipping_address'],
                                                                'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],
                                                                'country'=>$data['shipping_country'],'mobile'=>$data['shipping_mobile'],
                                                                'pincode'=>$data['shipping_pincode']

                                                            ]);
                }else{
                    //add shipping address
                    $shipping = new DeliveryAddress;
                    $shipping->user_id = $user_id;
                    $shipping->user_email = $user_email;
                    $shipping->name = $data['shipping_name'];
                    $shipping->address = $data['shipping_address'];
                    $shipping->city = $data['shipping_city'];
                    $shipping->state = $data['shipping_state'];
                    $shipping->country = $data['shipping_country'];
                    $shipping->pincode = $data['shipping_pincode'];
                    $shipping->mobile = $data['shipping_mobile'];
                    $shipping->save();
                }

                return redirect()->action('ProductsController@orderReview');
            }

        // echo "<pre>";print_r($data);die;

        return view('products.checkout')
                                    ->with(compact('userDetails','countries','shippingDetails'));


    }
    public function orderReview(Request $request){

        // $session_id = Session::get('session_id');

        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id',$user_id)->first();
        //check if shipping address exisites
        $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first();
        //cart details on order review page
        // $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();

        
        foreach($userCart as $key=> $product){
            // echo "<pre>";print_r($userCart);die;
            $productDetails = Product::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
     
        return view('products.order_review')->with(compact('userDetails','shippingDetails','userCart'));
    }
    public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;
            //get shipping address of user
            $shippingDetails = DeliveryAddress::where(['user_email'=>$user_email])->first();

            $orders = new Order;
            $orders->user_id = $user_id;
            $orders->user_email = $user_email;
            $orders->name = $shippingDetails['name'];
            $orders->address = $shippingDetails['address'];
            $orders->city = $shippingDetails['city'];
            $orders->state = $shippingDetails['state'];
            $orders->country = $shippingDetails['country'];
            $orders->pincode = $shippingDetails['pincode'];
            $orders->mobile = $shippingDetails['mobile'];
            $orders->payment_method = $data['payment_method'];
            $orders->grand_total = $data['grand_total'];
            $orders->order_status = 'New';
            $orders->save();
            // echo "<pre>";print_r($shipping);die; 
            $order_id = DB::getPdo()->lastInsertId();     //gets the id of the last inserted product
            
            $cartProducts = DB::table('cart')->where(['user_email'=>$user_email])->get();
            
            foreach($cartProducts as $pro){
                $cartPro = new OrdersProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_code = $pro->product_code;
                $cartPro->product_name = $pro->product_name;
                $cartPro->product_color = $pro->product_color;
                $cartPro->product_price = $pro->price;
                $cartPro->product_size= $pro->size;
                $cartPro->product_qty= $pro->quantity;
                $cartPro->save();

            }
            Session::put('order_id',$order_id);
            Session::put('grand_total',$data['grand_total']);

            if($data['payment_method']=="COD"){
                $productDetails = Order::with('orders')->where('id',$order_id)->first();
                $userDetails = User::where('id',$user_id)->first();
                //  echo "<pre>";print_r($userDetails);die; 


                /*code for order email start*/
                $email = $user_email;
                $messageData = [
                    'email'=>$email,
                    'name'=>$shippingDetails->name,
                    'order_id'=>$order_id,
                    'productDetails'=>$productDetails,
                    'userDetails'=>$userDetails
                ];
                Mail::send('emails.order',$messageData, function($message) use($email){
                    $message->to($email)->subject('COD Order Placed on E-Shopper');
                });

                /*code for order email start*/
                return redirect('/thanks')->with('flash_message_success','Order Confirmed!!');
            }else{
                return redirect()->back()->with('flash_message_error','Error while processing');

            }
            
        }

    }
    public function thanks(Request $request){
        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();

        return view('products.thanks');

    }
    public function userOrders(Request $request){
        $user_id = Auth::user()->id;
        $orders = Order::with('Orders')->where('user_id',$user_id)->orderBy('id','DESC')->get(); //orders is function inside order model having hasMany relation.
            // echo "<pre>";print_r($orders);die; 
        return view('orders.user_orders')->with(compact('orders'));

    }
    public function userOrderDetails($order_id){
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
            // echo "<pre>";print_r($orderDetails);die; 

        return view('orders.user_order_details')->with(compact('orderDetails'));

    }
    public function viewOrders(){
        $orders = Order::with('orders')->orderBy('id','DESC')->get();
            // echo "<pre>";print_r($orders);die; 
        return view('admin.orders.view-orders')->with(compact('orders'));

    }
    public function viewOrderDetails($order_id){
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $user_id = $orderDetails->user_id;

        $userDetails = User::where('id',$user_id)->first();

        return view('admin.orders.order_details')->with(compact('orderDetails','userDetails'));

    }
    public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //  echo "<pre>";print_r($data);die; 
            Order::where(['id'=>$data['order_id']])->update(['order_status'=>$data['order_status']]);
            return redirect()->back()->with('flash_message_success','Order Status Updated To '.$data['order_status']);


        }

    }
    public function searchProducts(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            // print_r($data);die;
        //get all categories and sub categories
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $search_product = $data['product'];
        $productsAll = Product::where(function($query) use($search_product){
            $query->where('product_name','like','%'.$search_product.'%')
                    ->orWhere('product_code','like','%'.$search_product.'%')
                    ->orWhere('product_color','like','%'.$search_product.'%')
                    ->orWhere('description','like','%'.$search_product.'%');  
                         
                    })->Where('status',1)->get();

        return view('products.listing')->with(compact('search_product','productsAll','categories'));


        }

    }
    public function viewOrderInvoice($order_id){
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('admin.orders.order_invoice')->with(compact('orderDetails','userDetails'));

    }
    public function deleteOrder($id){
        Order::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Order Deleted Successfully!!');
    }
    public function filter(Request $request){
        $data = $request->all();
        // echo "<pre>";print_r($data);die;
        $colorUrl = "";
        if (!empty($data['colorFilter'])) {
           foreach ($data['colorFilter'] as  $color) {
               if (empty($colorUrl)) {
                   $colorUrl = "&color=".$color;
               }else{
                   $colorUrl .= "-".$color;
               }
           }
        }

        $sizeUrl = "";
        if (!empty($data['sizeFilter'])) {
           foreach ($data['sizeFilter'] as  $size) {
               if (empty($sizeUrl)) {
                   $sizeUrl = "&size=".$size;
               }else{
                   $sizeUrl .= "-".$size;
               }
           }
        }
        $finalUrl = "products/".$data['url']."?".$colorUrl.$sizeUrl;
        return redirect::to($finalUrl);


    }
    public function viewPDFInvoice($order_id){
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
                

        $output = '
        <style>
            
            content: "";
            display: table;
            clear: both;
          }
          
          a {
            color: #5D6975;
            text-decoration: underline;
          }
          
          body {
            position: relative;
            width: 21cm;  
            height: 29.7cm; 
            margin: 0 auto; 
            color: #001028;
            background: #FFFFFF; 
            font-family: Arial, sans-serif; 
            font-size: 12px; 
            font-family: Arial;
          }
          
          header {
            padding: 10px 0;
            padding-bottom:20px;
            margin-bottom: 30px;
          }
          
          #logo {
            text-align: center;
            margin-bottom: 10px;
          }
          
          #logo img {
            width: 90px;
          }
          
          h1 {
            border-top: 1px solid  #5D6975;
            border-bottom: 1px solid  #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
          }
          
          #project {
            float: left;
          }
          
          #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
          }
          
          #company {
            float: right;
            text-align: right;
          }
          
          #project div,
          #company div {
            white-space: nowrap;        
          }
          
          table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
          }
          
          table tr:nth-child(2n-1) td {
            background: #F5F5F5;
          }
          
          table th,
          table td {
            text-align: center;
          }
          
          table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;        
            font-weight: normal;
          }
          
          table .service,
          table .desc {
            text-align: left;
          }
          
          table td {
            padding: 20px;
            text-align: right;
          }
          
          table td.service,
          table td.desc {
            vertical-align: top;
          }
          
          table td.unit,
          table td.qty,
          table td.total {
            font-size: 1.2em;
          }
          
          table td.grand {
            border-top: 1px solid #5D6975;;
          }
          
          #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
          }
          footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
          }
        </style>

        <body>
            <header class="clearfix">
                <div id="logo">
                <img src="images/frontend_images/home/logo.png" >
                
                </div>
                <h1>ORDER ID #'.$orderDetails->id.'</h1>
                <div id="project" class="clearfix">
                    <div><strong> Billing Address </strong></div>
                    <div>'.$userDetails->name.'</div>
                    <div>'.$userDetails->email.'</div>
                    <div>'.$userDetails->mobile.'</div>
                    <div>'.$userDetails->city.'</div>
                    <div>'.$userDetails->state.'</div>
                    <div>'.$userDetails->address.'</div>
                    <div>'.$userDetails->pincode.'</div>
                </div>
                <div id="roject" style="float:right" >
                <div> <strong> Shipping Address </sreong></div>
                    <div>'.$orderDetails->name.'</div>
                    <div>'.$orderDetails->email.'</div>
                    <div>'.$orderDetails->mobile.'</div>
                    <div>'.$orderDetails->city.'</div>
                    <div>'.$orderDetails->state.'</div>
                    <div>'.$orderDetails->address.'</div>
                    <div>'.$orderDetails->pincode.'</div>
                </div>
            </header>
            <main style="margin-top:20%">
                <table>
                    <thead>
                        <tr>
                            <th class="service">Product</th>
                            <th class="desc">Size</th>
                            <th>Color</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Totals</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>';
                        $total_amount = 0;
                        foreach($orderDetails->orders as $order){

                    $output.='<td class="service">'.$order->product_name.'</td>
                            <td class="desc">'.$order->product_size.'</td>
                            <td class="unit">'.$order->product_color.'</td>
                            <td class="qty">$'.$order->product_price.'</td>
                            <td class="qty">'.$order->product_qty.'</td>
                            <td class="total">$'.$order->product_qty*$order->product_price.'</td>
                        </tr>';

                        $total_amount = $total_amount + $order->product_qty*$order->product_price;
                    }
                        
                $output .=' </tbody>
                </table>
                <div id="notices">
                    <div>NOTICE:</div>
                    <div class="notice">Please Check Your Order Status At http://adhikarisudarshan.com.np/orders.</div>
                </div>
            </main>
       
        </body>';


            // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($output);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
}
