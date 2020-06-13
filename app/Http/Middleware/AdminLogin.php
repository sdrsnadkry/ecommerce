<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Admin;
use Route;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty(Session::has('adminSession'))) {
            return  redirect('/admin');
        } else {
            $adminDetails = Admin::where('username', Session::get('adminSession'))->first(); //ref: Session::put('adminSession', $data['username']); in login function
            $adminDetails = json_decode(json_encode($adminDetails), true);
            if ($adminDetails['type']== "Admin") {
                $adminDetails['categories_access'] = 1;
                $adminDetails['products_access'] = 1;
                $adminDetails['banners_access'] = 1;
                $adminDetails['brands_access'] = 1;
                $adminDetails['orders_access'] = 1;
                $adminDetails['users_access'] = 1;
                $adminDetails['cms_pages_access'] = 1;
                $adminDetails['inquiries_access'] = 1;
            }
            Session::put('adminDetails', $adminDetails);
            
            // echo "<pre>";print_r(Session::get('adminDetails'));die;

            $currentPath = Route::getFacadeRoot()->current()->uri();

            if ($currentPath == "admin/view-categories" && Session::get('adminDetails')['categories_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/view-products" && Session::get('adminDetails')['products_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/view-orders" && Session::get('adminDetails')['orders_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/view-banners" && Session::get('adminDetails')['banners_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/view-brands" && Session::get('adminDetails')['brands_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/view-users" && Session::get('adminDetails')['users_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/view-cms-pages" && Session::get('adminDetails')['cms_pages_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/view-inquiry" && Session::get('adminDetails')['inquiries_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/view-admins" && Session::get('adminDetails')['type']=="Sub-Admin") { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/add-category" && Session::get('adminDetails')['categories_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/add-product" && Session::get('adminDetails')['products_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/add-banner" && Session::get('adminDetails')['banners_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/add-brand" && Session::get('adminDetails')['brands_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/add-cms-page" && Session::get('adminDetails')['cms_pages_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/add-admin" && Session::get('adminDetails')['type']=="Sub-Admin") { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/edit-admin/{id}" && Session::get('adminDetails')['type']=="Sub-Admin") { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/edit-category/{id}" && Session::get('adminDetails')['categories_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/edit-product/{id}" && Session::get('adminDetails')['products_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/edit-banner/{id}" && Session::get('adminDetails')['banners_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/edit-brand/{id}" && Session::get('adminDetails')['brands_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/edit-cms-page/{id}" && Session::get('adminDetails')['cms_pages_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/delete-admin/{id}" && Session::get('adminDetails')['type']=="Sub-Admin") { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/delete-category/{id}" && Session::get('adminDetails')['categories_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/delete-product/{id}" && Session::get('adminDetails')['products_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/delete-banner/{id}" && Session::get('adminDetails')['banners_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/delete-brand/{id}" && Session::get('adminDetails')['brands_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/delete-order/{id}" && Session::get('adminDetails')['orders_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/delete-user/{id}" && Session::get('adminDetails')['users_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/delete-inquiry/{id}" && Session::get('adminDetails')['inquiries_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            if ($currentPath == "admin/delete-cms-page/{id}" && Session::get('adminDetails')['cms_pages_access']==0) { return redirect('/admin/dashboard')->with('flash_message_error', "You dont have permission to access this module"); }
            
        }
        return $next($request);
    }
}
