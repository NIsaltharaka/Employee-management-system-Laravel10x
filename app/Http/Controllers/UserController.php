<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; 
use App\Models\User; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    // login
    public function login()
    {
        return view('auth.login');
    }

    // register
    public function register()
    {
        if(session()->has('loggedInUser')){
            return redirect('/dashboard');
        }
        else{
           return view('auth.register'); 
        }
        
    }

    // forgot
    public function forgot()
    {
        if(session()->has('loggedInUser')){
            return redirect('/dashboard');
        }
        else{
           return view('auth.forgot');
        }
        
    }

    // reset password
    public function reset(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        return view('auth.reset', ['email' => $email, 'token' => $token]);
    }

    // handle register user ajax request
    public function saveUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|min:6|max:8',
            'cpassword' => 'required|min:6|max:8|same:password',
        ], [
            'cpassword.same' => 'Password did not match!',
            'cpassword.required' => 'Confirm password is required!',
        ]);


        if (!$request->has('name')) {
            $validator->errors()->add('name', 'The name field is required.');
        }

        if ($validator->fails()) {
            return response()->json([
                'status' => '400',
                'messages' => $validator->errors()->first(),
            ]);
        } else {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();
            

            return response()->json([
                'status' => '200',
                'messages' => 'Registration successful',
                
            ]);
        }
    }


    // handle login user ajax request
    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required|min:6|max:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '400',
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $request->session()->put('loggedInUser', $user->id);
                    return response()->json([
                        'status' => 200,
                        'messages' => 'login successfull'
                    ]);
                } else {
                    return response()->json([
                        'status' => 400,
                        'messages' => 'email or password incorrect'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 400,
                    'messages' => 'user not found'
                ]);
            }
        }
    }

    //logout function
    public function logout(){
        if(session()->has('loggedInUser')){
            session()->pull('loggedInUser');
            return redirect('/');
        }
    }


    //handle forgot password ajax request
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->errors()->first(),
            ]);
        } else {
            $token = Str::uuid();
            $user = DB::table('users')->where('email', $request->email)->first();
            $details = [
                'body' => route('reset', ['email' => $request->email, 'token' => $token])
            ];


            if ($user) {
                User::where('email', $request->email)->update([
                    'token' => $token,
                    'token_expire' => Carbon::now()->addMinutes(10)->toDateTimeString()
                ]);

                Mail::to($request->email)->send(new ForgotPassword($details));
                return response()->json([
                    'status' => 200,
                    'messages' => 'Your reset password link has been sent!',
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'messages' => 'This email is not registered',
                ]);
            }
        }
    }
               


    //handle reset password ajax request

    public function resetpassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'npassword' => 'required|min:6|max:8',
            'cnpassword' => 'required|min:6|max:8|same:npassword'
        ], [
            'cnpassword.same' => 'password did not matched'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            $user = DB::table('users')->where('email', $request->email)->whereNotNull('token')
                ->where('token', $request->token)->where('token_expire', '>', Carbon::now())->exists();

            if ($user) {
                User::where('email', $request->email)->Update([
                    'password' => Hash::make($request->npassword),
                    'token' => null,
                    'token_expire' => null
                ]);
                return response()->json([
                    'status' => 200,
                    'messages' => 'new password updated successfully.'
                ]);
            } else {
                return response()->json([
                    'status' => 40,
                    'messages' => 'reset link expired.Request for a new password link'
                ]);
            }
        }

    }
   
}


