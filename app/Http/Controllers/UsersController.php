<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use Cache;
use App\Country;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class UsersController extends Controller
{
    public function userLoginRegister(){
        return view('users.login_register');
    }
   
    public function register(Request $request){
        if($request->isMEthod('post')){
            $data = $request->all();

            //check if user already exists
            $usersCount = User::where('email',$data['email'])->count();
            if($usersCount>0){
                return redirect()->back()->with('flash_message_error', 'Email ID already exists');
            }else{
                //  echo "<pre>";print_r($data);die;
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                date_default_timezone_set('Asia/Kolkata');
                $user->created_at = date('Y-m-d H:i:s');
                $user->updated_at = date('Y-m-d H:i:s');
                $user->save();
                //send confirmation email
                $email = $data['email'];
                $messageData = ['email'=>$data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
                Mail::send('emails.confirmation',$messageData,function($message) use($email){
                    $message->to($email)->subject('Confirm Your Email Account on E-Shopper');

                });
                return redirect()->back()->with('flash_message_success', 'Please Confirm your Email to Login!! ');

                if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                    Session::put('frontSession',$data['email']);

                    if (!empty(Session::get('session_id'))) {
                        $session_id = Session::get('session_id');
                        DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                    }

                    return redirect('/cart');
                }
            }
        }
    }
    //Added to verify email is unique for all users
    public function checkEmail(Request $request){
        $data = $request->all();
        $usersCount = User::where('email',$data['email'])->count();
        if($usersCount>0){
           echo "false";
        }else{
            echo "true";die;  
        }

    }

    public function logout(){
        Cache::flush();
        Auth::logout();
        // echo $test=Session::get()
        Session::forget('frontSession');
        Session::forget('session_id');
        return redirect('/');
    }
    public function login(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all(); 

            // echo "<pre>";print_r($data);die;
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $userStatus = User::where('email',$data['email'])->first();
                if ($userStatus->status == 0) {
                return redirect()->back()->with('flash_message_error','Your Account Has Not Been Activated. Please Verify Your Email Or Contact Admin!!');    
                }
                Session::put('frontSession',$data['email']);


                if (!empty(Session::get('session_id'))) {
                    $session_id = Session::get('session_id');
                    DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);
                }

               return redirect('/cart');
            }else{
                return redirect()->back()->with('flash_message_error','Invalid username or password');
            }
        }
    }

    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        $countries = Country::get();
        //  echo "<pre>";print_r($data);die;
        
        if($request->isMethod('post')){
            $data = $request->all();
            $user = User::find($user_id);
            if (empty($data['pincode'])) {
                $user->pincode = "";
            }else{
                $user->pincode = $data['pincode'];
            }
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->mobile = $data['mobile'];
            $user->save();

            return redirect()->back()->with('flash_message_success','Account details updated successfully');
        }



        return view('users.account')->with(compact('countries','userDetails'));
    }

    public function chkUserPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $user_id = Auth::user()->id;
        // echo "<pre>";print_r($user_id);die;
        $check_password = User::where('id',$user_id)->first();

        if (Hash::check($current_password,$check_password->password)) {
            echo"true";die;
        }else{
            echo "false";die;
        }

    }

    public function updatePassword(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            $current_password = $data['current_pwd'];
            $check_password = User::where(['email'=>Auth::user()->email])->first();
            if(Hash::check($current_password,$check_password->password)){
                $password = bcrypt($data['new_pwd']);
                User::where(['email'=>Auth::user()->email])->update(['password'=>$password]);
                // dd($password);
                return redirect('/account')->with('flash_message_success','Password Changed Successfully');
            }else{
                return redirect('/account')->with('flash_message_error','Incorrect Current Password');
            }
        }

    }

    public function confirmAccount($email){
        $email = base64_decode($email);
        $userCount = User::where('email',$email)->count();
        if ($userCount > 0) {
            $userDetails = User::where('email',$email)->first();
            // echo "hello";die;
            if($userDetails->status == 1){
                return redirect('/login-register')->with('flash_message_success','Your Account is already activated. Please proceed to login!!');    
           }else{
               User::where('email',$email)->update(['status'=>1]);
               //code to send register email 
               $messageData = ['email'=>$email,'name'=>$userDetails->name];
               Mail::send('emails.welcome',$messageData,function($message) use($email){
                   $message->to($email)->subject('Elcome to E-com Website');

               });
               //code to send registered email
               return redirect('/login-register')->with('flash_message_success','Congratulations!!! Your Account is now activated. Please Proceed to Login');    
           }
        }else{
            abort(404);
        }

    }
    public function viewUsers(){
        $users = User::get();
        return view('admin.users.view_users')->with(compact('users'));
    }
    public function forgotPassword(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            // print_r($data);die;
            $userCount = User::where('email',$data['email'])->count();
            if ($userCount == 0) {
                return redirect()->back()->with('flash_message_error','Email Doesnot Exists!!');                    
            }
            //get user details
            $userDetails = User::where('email',$data['email'])->first();
            //generate random password
            $random_password = Str::random(12);
            //bcrypt password so nobody can access it
            $new_password = bcrypt($random_password);
            //update password
            $email = $data['email'];
            User::where('email',$data['email'])->update(['password'=> $new_password]);

            $messageData = ['email'=>$userDetails->email,
                            'password'=>$random_password,
                            'name'=>$userDetails->name
                           ];
            Mail::send('emails.forgotpassword',$messageData,function($message) use($email){
                $message->to($email)->subject('Forgot Password?? E-SSOPPER');
                
            });
            return redirect('/login-register')->with('flash_message_success','Please Check Your Email For Your New Password!!');                    

            
        }
        return view('users.forgot_password');
    }

    public function deleteUser($id){
        User::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','User Deleted Successfully!!');                    


    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {

            return redirect('/cart')->with('flash_message_error','Something went wrong while logging in!');
        }

         // check if they're an existing user
         $existingUser = User::where('email', $user->email)->first();
         if($existingUser){
            // log them in
            auth()->login($existingUser, true);
            Session::put('frontSession',$user->email);

            if (!empty(Session::get('session_id'))) {
                $session_id = Session::get('session_id');
                DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$user->email]);
            }
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->status       = '1';
            $newUser->save();
            auth()->login($newUser, true);

            Session::put('frontSession',$user->email);

            if (!empty(Session::get('session_id'))) {
                $session_id = Session::get('session_id');
                DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$user->email]);
            }

           
        }
        return redirect()->to('/cart');      
       
    }
    public function checkOnlineStatus(Request $request){
        $data = $request->all();
        $temp_user_id = $data['id'];
        $user_id = explode(' ', $temp_user_id );      
        // echo print_r($user_id);die;

        foreach($user_id as $ids){            
            $isOnline = User::isOnline($ids);
            if ($isOnline) {
                echo "Online ";                                       
                }else{
                echo "Offline " ;                                       
                }
        }  
        
    }

}
