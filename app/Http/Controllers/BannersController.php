<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banners;
use Image;

class BannersController extends Controller
{
    //
    public function addBanner(Request $request){
        if ($request->isMethod('post')) {
            $data =$request->all();
            // echo "<pre>";print_r($data);die;
            $banner = new Banners;
            $banner->title = $data['title'];
            $banner->link = $data['link'];            
            if (empty($data['status'])){
                $banner->status = 0;
            }else{
                $banner->status = 1;
            }
            /********************code for image upload***************** */
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                   $extension = $image_tmp->getClientOriginalExtension();
                   $filename = "Image-".date('Ymdhis').rand(0,999).'.'.$extension;
                   $banner_path =   'images/frontend_images/banners/'.$filename; 
                   //resize images
                   Image::make($image_tmp)->resize(1000,500)->save($banner_path);
                   //store images name in product tables
                   $banner->image = $filename; 
                }
            }  
            $banner->save();
            return redirect()->back()->with('flash_message_success','Banner Added Successfully');

        }
        return view('admin.banners.add_banner');

    }

    public function viewBanners(){
        $banners = Banners::orderby('id','DESC')->get();
        // echo "<pre>"; print_r($products); die;
        return view('admin.banners.view_banners')->with(compact('banners'));
    }
    public function editBanner(Request $request, $id=null){
        
        $bannerDetails = Banners::where(['id'=>$id])->first();
        // $bannerDetails = json_decode(json_encode($bannerDetails));
        //   echo "<pre>"; print_r($bannerDetails); die;
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
                    unlink(public_path().'/images/frontend_images/banners/'.$updateImageDelete);
                   
                }
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                   $extension = $image_tmp->getClientOriginalExtension();
                   $filename = "Image-".date('Ymdhis').rand(0,999).'.'.$extension;
                   $banner_path =   'images/frontend_images/banners/'.$filename;
                  
                   //resize images
                   Image::make($image_tmp)->resize(1000,500)->save($banner_path);
                
                   //store images name in product table
                }
            }
            else{
                $filename = $data['current_image']; 
            }
            Banners::where(['id'=>$id])->update(['title'=>$data['title'],
                                                'link'=>$data['link'],
                                                'image'=>$filename,
                                                'status'=>$status]);
            return redirect('/admin/view-banners')->with('flash_message_success','Banner was updated successfully.');
        }
        return view('admin.banners.edit_banner')->with(compact('bannerDetails'));

    }

    public function deleteBanner(Request $request, $id=null){
        // $bannerDetails = json_decode(json_encode($bannerDetails));
        //   echo "<pre>"; print_r($id); die;
        $datas = Banners::where(['id'=>$id])->first();
        $delImage = $datas->image;        
        $success = Banners::where(['id'=>$id])->delete();
        if($success){
            if (public_path().'/images/frontend_images/banners/'.$delImage) {
                unlink(public_path().'/images/frontend_images/banners/'.$delImage);
            }
            
        }
        return redirect()->back()->with('flash_message_success','Banner deleted succssfully');
    }
}
