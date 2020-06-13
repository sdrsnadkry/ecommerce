<?php

namespace App\Http\Controllers;

use App\CmsPage;
use App\Inquiry;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CmsController extends Controller
{
    //
    public function addCmsPage(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //    echo "<pre>";print_r($data);die;
            if (empty($data['status'])) {
                $status = 0;
            } else {
                $status = 1;
            }
            $cmspage = new CmsPage;
            $cmspage->title = $data['title'];
            $cmspage->url = $data['url'];
            $cmspage->description = $data['description'];
            $cmspage->status = $status;
            $cmspage->save();
            return redirect()->back()->with('flash_message_success', $data['title'].' Page Created Successfully');
        }
        return view('admin.pages.add_cms_page');
    }
    public function viewCmsPages()
    {
        $cmsPages = CmsPage::get();
        return view('admin.pages.view_cms_pages')->with(compact('cmsPages'));
    }
    public function editCmsPage(Request $request, $id=null)
    {
        $pageDetails = CmsPage::where('id', $id)->first();
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (empty($data['status'])) {
                $status = 0;
            } else {
                $status = 1;
            }
            CmsPage::where('id', $id)->update(['title'=>$data['title'],
                                            'url'=>$data['url'],
                                            'description'=>$data['description'],
                                            'status'=>$status
                                            ]);
            return redirect('/admin/view-cms-pages')->with('flash_message_success', $data['title'].' Page Updated Successfully');
        }
        return view('admin.pages.edit_cms_page')->with(compact('pageDetails'));
    }
    public function deleteCmsPage($id=null)
    {
        $success = CmsPage::where(['id'=>$id])->delete();
        
        return redirect()->back()->with('flash_message_success', ' Page deleted succssfully');
    }
    public function cmsPage($url)
    {
        //check if page is disabled
        $cmsPageCount = CmsPage::where(['url'=>$url, 'status'=>1])->count();
        if ($cmsPageCount > 0) {
            $cmsPageDetails = CmsPage::where(['url'=>$url,'status'=>1])->first();
        } else {
            abort(404);
        }

        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        return view('pages.cms_pages')->with(compact('cmsPageDetails', 'categories'));
    }
    public function contactsPage(Request $request)
    {
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        if ($request->isMethod('post')) {
            $data = $request->all();
            $email = "sadmin@yopmail.com";
            $validator = Validator::make($request->all(), [
                'name'=> 'required|max:255',
                'email'=> 'required|max:255',
                'subject'=> 'required|max:255',
                'message'=> 'required'
            ]);
            if ($validator->fails()) {
                return redirect()
                            ->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            $inquiry = new Inquiry;
            $inquiry->name = $data['name'];
            $inquiry->sender_email = $data['email'];
            $inquiry->subject = $data['subject'];
            $inquiry->message = $data['message'];
            $inquiry->save();
            $messageData = ['email'=>$data['email'],
                            'name'=>$data['name'],
                            'subject'=>$data['subject'],
                            'enquiry'=>$data['message']
                           ];
            Mail::send('emails.enquiry', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Enquiry from user');
            });
            // echo "test";die;
            return redirect()->back()->with('flash_message_success', 'Thankyou For Being With US. Your Information Has Been Sent To Admin!!');
        }
        return view('pages.contact')->with(compact('categories'));
    }
    public function viewInquiry()
    {
        $inquiryDetails = Inquiry::orderBy('id', 'DESC')->get();
        return view('admin.inquiry.view_inquiry')->with(compact('inquiryDetails'));
    }
    public function deleteInquiry($id=null)
    {
        Inquiry::where('id', $id)->delete();
        return redirect()->back()->with('flash_message_success', 'Inquiry Deleted Successfully!');
    }

    public function addPost(Request $request)
    {
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            // $email = "sdadkry95@gmail.com";
            $inquiry = new Inquiry;
            $inquiry->name = $data['name'];
            $inquiry->sender_email = $data['email'];
            $inquiry->subject = $data['subject'];
            $inquiry->message = $data['message'];
            $inquiry->save();
            // $messageData = ['email'=>$data['email'],
            //                 'name'=>$data['name'],
            //                 'subject'=>$data['subject'],
            //                 'enquiry'=>$data['message']
            //                ];
            // Mail::send('emails.enquiry',$messageData,function($message) use($email){
            //     $message->to($email)->subject('Enquiry from user');
            // });
            // echo "test";die;
            echo "Thankyou!! Your Inquiry is now submitted;";
            die;
            // return redirect()->back()->with('flash_message_success','Thankyou For Being With US. Your Information Has Been Sent To Admin!!');
        }
        return view('pages.post')->with(compact('categories'));
    }
    public function getInquiryVue()
    {
        $vueInquiries = Inquiry::orderBy('id', "DESC")->get();
        $vueInquiries = json_encode($vueInquiries);

        return $vueInquiries;

    }
    public function viewInquiryVue()
    {
       

        return view('admin.inquiry.view_inquiry_vue');

    }
}
