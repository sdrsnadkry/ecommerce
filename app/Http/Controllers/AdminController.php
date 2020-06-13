<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Admin;
use App\Brand;
use App\Order;
use App\Banners;
use App\CmsPage;
use App\Inquiry;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->input();
            $adminCount = Admin::where(['username'=>$data['username'],'password'=>md5($data['password']),'status'=>1])->count();
            if ($adminCount>0) {
                Session::put('adminSession', $data['username']);
                return redirect('/admin/dashboard')->with('flash_message_success', 'Login Successful');
            } else {
                return redirect('/admin')->with('flash_message_error', 'Invalid username or password');
            }
        }

        return view('admin.admin_login');
    }
    public function dashboard()
    {
        // if (Session::has('adminSession')) {
        #for simple login
        // }else{
        //     return redirect('/admin')->with('flash_message_error','Please Login To Access Dashboard');
        // }
        $categoryCount = Category::count();
        $productCount = Product::count();
        $bannerCount = Banners::count();
        $brandsCount = Brand::count();
        $orderCount = Order::count();
        $usersCount = User::count();
        $cmsCount = CmsPage::count();
        $inquiriesCount = Inquiry::count();
        // print_r($categoryCount);die;

        return view('admin.dashboard')->with(compact('categoryCount', 'productCount', 'bannerCount', 'brandsCount', 'orderCount', 'usersCount', 'cmsCount', 'inquiriesCount'));
    }
    public function settings()
    {
        $adminDetails = Admin::where(['username'=>Session::get('adminSession')])->first();

        return view('admin.settings')->with(compact('adminDetails'));
    }
    public function checkPassword(Request $request)
    {
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $adminCount = Admin::where(['username'=>Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
        if ($adminCount == 1) {
            echo "true";
            die;
        } else {
            echo "false";
            die;
        }
    }
    public function updatePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // $current_password = $data['current_pwd']; //just to understand not used in code

            $adminCount = Admin::where(['username'=>Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
            
            // echo $adminCount;die;

            if ($adminCount == 1) {
                $password = md5($data['new_pwd']);
                Admin::where('username', Session::get('adminSession'))->update(['password'=>$password]);
                // dd($password);
                return redirect('/admin/settings')->with('flash_message_success', 'Password Changed Successfully');
            } else {
                return redirect('/admin/settings')->with('flash_message_error', 'Incorrect Current Password');
            }
        }
    }
    public function logout()
    {
        Session::flush();
        return redirect('/admin')->with('flash_message_success', 'Logged Out Successfully');
    }
    public function viewAdmins()
    {
        $admins = Admin::get();
        return view('admin.admins.view_admins')->with(compact('admins'));
    }
    public function addAdmins(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            if (!empty($data['status'])) {
                $status = 1;
            }else{
                $status = 0;
            }
            $adminCount = Admin::where('username', $data['username'])->count();
            if ($adminCount > 0) {
                return redirect()->back()->with('flash_message_error', "Username Already Exists");
            } else {
                if ($data['type'] == "Admin") {
                    $admin = new Admin;
                    $admin->type = $data['type'];
                    $admin->username = $data['username'];
                    $admin->password = md5($data['password']);
                    $admin->status = $status;
                    $admin->save();
                    return redirect('admin/view-admins')->with('flash_message_success', 'Admin Added Successfully');
                } elseif ($data['type'] == "Sub-Admin") {
                    if (!empty($data['categories_access'])) { $categories_access = 1; }else{ $categories_access = 0; }
                    if (!empty($data['products_access'])) { $products_access = 1; }else{ $products_access = 0; }
                    if (!empty($data['users_access'])) { $users_access = 1; }else{ $users_access = 0; }
                    if (!empty($data['orders_access'])) { $orders_access = 1; }else{ $orders_access = 0; }
                    if (!empty($data['banners_access'])) { $banners_access = 1; }else{ $banners_access = 0; }
                    if (!empty($data['brands_access'])) { $brands_access = 1; }else{ $brands_access = 0; }
                    if (!empty($data['cms_pages_access'])) { $cms_pages_access = 1; }else{ $cms_pages_access = 0; }
                    if (!empty($data['inquiries_access'])) { $inquiries_access = 1; }else{ $inquiries_access = 0; }
                    $admin = new Admin;
                    $admin->username = $data['username'];
                    $admin->type = $data['type'];
                    $admin->password = md5($data['password']);
                    $admin->status = $status;
                    $admin->categories_access = $categories_access;
                    $admin->products_access = $products_access;
                    $admin->users_access = $users_access;
                    $admin->orders_access = $orders_access;
                    $admin->banners_access = $banners_access;
                    $admin->brands_access = $brands_access;
                    $admin->cms_pages_access = $cms_pages_access;
                    $admin->inquiries_access = $inquiries_access;
                    $admin->save();
                    return redirect('admin/view-admins')->with('flash_message_success', 'Sub-Admin Added Successfully');
                }
            }
        }
        return view('admin.admins.add_admins');
    }
    public function editAdmins(Request $request, $id=null){
        $adminDetails = Admin::where('id', $id)->first();
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (!empty($data['status'])) { $status = 1; }else{ $status = 0; }
            if ($data['type'] == "Admin") {
                Admin::where('username', $data['username'])->update(['password'=>md5($data['password']), 'status'=>$status]);
               
                return redirect('admin/view-admins')->with('flash_message_success', 'Admin\'s Info Updated Successfully');
            } elseif ($data['type'] == "Sub-Admin") {
                if (!empty($data['categories_access'])) { $categories_access = 1; }else{ $categories_access = 0; }
                if (!empty($data['products_access'])) { $products_access = 1; }else{ $products_access = 0; }
                if (!empty($data['users_access'])) { $users_access = 1; }else{ $users_access = 0; }
                if (!empty($data['orders_access'])) { $orders_access = 1; }else{ $orders_access = 0; }
                if (!empty($data['banners_access'])) { $banners_access = 1; }else{ $banners_access = 0; }
                if (!empty($data['brands_access'])) { $brands_access = 1; }else{ $brands_access = 0; }
                if (!empty($data['cms_pages_access'])) { $cms_pages_access = 1; }else{ $cms_pages_access = 0; }
                if (!empty($data['inquiries_access'])) { $inquiries_access = 1; }else{ $inquiries_access = 0; }

                Admin::where('username', $data['username'])->update([
                                                'status'=>$status,
                                                'password'=>md5($data['password']),
                                                'categories_access'=>$categories_access,
                                                'products_access'=>$products_access,
                                                'orders_access'=>$orders_access,
                                                'users_access'=>$users_access,
                                                'banners_access'=>$banners_access,
                                                'brands_access'=>$brands_access,
                                                'cms_pages_access'=>$cms_pages_access,
                                                'inquiries_access'=>$inquiries_access,
                                                ]);
                return redirect('/admin/view-admins')->with('flash_message_success', 'Sub-Admin\'s Info Updated Successfully');
            }
            

        }

        return view('admin.admins.edit_admins')->with(compact('adminDetails'));


    }
    public function deleteAdmin($id)
    {
        Admin::where('id', $id)->delete();
        return redirect()->back()->with('flash_message_success', 'Admin Deleted Successfully!!');
    }
}
