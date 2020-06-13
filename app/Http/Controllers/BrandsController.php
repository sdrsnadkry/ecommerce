<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use Image;

class BrandsController extends Controller
{
    //
    public function addBrand(Request $request){
        if ($request->isMethod('post')) {
            $data =$request->all();
            // echo "<pre>";print_r($data);die;
            $brand = new Brand;
            $brand->name = $data['name'];
            $brand->url = $data['url'];            
            if (empty($data['status'])){
                $brand->status = 0;
            }else{
                $brand->status = 1;
            }
            /********************code for image upload***************** */
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                   $extension = $image_tmp->getClientOriginalExtension();
                   $filename = "Image-".date('Ymdhis').rand(0,999).'.'.$extension;
                   $brand_path =   'images/frontend_images/brands/'.$filename; 
                   //resize images
                   Image::make($image_tmp)->resize(350,150)->save($brand_path);
                   //store images name in product tables
                   $brand->image = $filename; 
                }
            }  
            $brand->save();
            return redirect()->back()->with('flash_message_success','Brand Added Successfully');

        }

        return view('admin.brands.add_brand');

    }
    public function viewBrands(){
        $brands = Brand::orderby('id','DESC')->get();
        // echo "<pre>"; print_r($products); die;
        return view('admin.brands.view_brands')->with(compact('brands'));

    }

    public function editBrand(Request $request, $id=null){
        $brandDetails = Brand::where(['id'=>$id])->first();
        // $brandDetails = json_decode(json_encode($brandDetails));
        //   echo "<pre>"; print_r($brandDetails); die;
        if($request->isMethod('post')){
            $data = $request->all();
            if (empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }  
            if($request->hasFile('image')){
                $updateImageDelete = $data['current_image'];
                if (!empty($updateImageDelete)) {
                    unlink(public_path().'/images/frontend_images/brands/'.$updateImageDelete);
                   
                }
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                   $extension = $image_tmp->getClientOriginalExtension();
                   $filename = "Image-".date('Ymdhis').rand(0,999).'.'.$extension;
                   $brand_path =   'images/frontend_images/brands/'.$filename;
                  
                   //resize images
                   Image::make($image_tmp)->resize(350,150)->save($brand_path);
                
                   //store images name in product table
                }
            }
            else{
                $filename = $data['current_image']; 
            }
            Brand::where(['id'=>$id])->update(['name'=>$data['name'],
                                                'url'=>$data['url'],
                                                'image'=>$filename,
                                                'status'=>$status]);
            return redirect('/admin/view-brands')->with('flash_message_success','brand was updated successfully.');
        }
        return view('admin.brands.edit_brand')->with(compact('brandDetails'));

    }
    public function deleteBrand($id=null){
         // $bannerDetails = json_decode(json_encode($bannerDetails));
        //   echo "<pre>"; print_r($id); die;
        $datas = Brand::where(['id'=>$id])->first();
        $delImage = $datas->image;        
        $success = Brand::where(['id'=>$id])->delete();
        if($success){
            if (public_path().'/images/frontend_images/brands/'.$delImage) {
                unlink(public_path().'/images/frontend_images/brands/'.$delImage);
            }
            
        }
        return redirect()->back()->with('flash_message_success','Brand deleted succssfully');

    }
}
