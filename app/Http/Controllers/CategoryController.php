<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //
    public function addCategory(Request $request){

        if ($request->isMethod('post')) {
            $data = $request->all();
        // echo "<pre>";print_r($data);die;
        if (empty($data['status'])){
            $status = 0;
        }else{
            $status = 1;
        }
            $category = new Category;
            $category->name = $data['category_name'];
            $category->parent_id = $data['parent_id'];
            // $category->parent_name = $data['parent_name'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->status = $status;
            $category->save();
            return redirect('/admin/view-categories')->with('flash_message_success','Category was added successfully');
        }
        /****************sub categories************ */
        $levels = Category::where(['parent_id'=>0])->get();
        /////////levels added to check only//////////////////////////
        $levelss = json_decode(json_encode($levels));
        return view('admin.categories.add_category')->with(compact('levels','levelss')); /*levels not used for names*/
    }

    public function viewCategories(){
        $categories = Category::get();

        // $categoriess = Category::where(['parent_id'=>0])->get();
        // foreach($categoriess as $cat){
        //     $parent_name = "<td>".$cat->name."</td>";
           
        // }
        return view('admin.categories.view_categories')->with(compact('categories'));
    }

    public function editCategory(Request $request, $id = null){
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // echo print_r($data);die
            // echo "</pre>";
            if (empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }

            Category::where(['id'=>$id])->update(['name'=>$data['category_name'],'description'=>$data['description'],'url'=>$data['url'],'parent_id'=>$data['parent_id'],'status'=>$status]);
            return redirect('/admin/view-categories')->with('flash_message_success','Category was updated successfully');
        }
        $categoryDetails = Category::where(['id'=>$id])->first();
        /****************sub categories************ */
        $levels = Category::where(['parent_id'=>0])->get();
        $levelss = json_decode(json_encode($levels));
        return view('admin.categories.edit_category')->with(compact('categoryDetails','levels','levelss'));

    }
    public function deleteCategory(Request $request, $id=null){
        if (!empty($id)) {
            Category::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Category was deleted successfully');
            
        }
        

    }
}
