<?php

namespace Modules\Providers\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Modules\Admin\Entities\State;
use Modules\Providers\Entities\Provider;

class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('providers::pages.auth.login');
    }

    public function dashboard()
    {
        $user = Auth('provider')->user();
        return view('providers::pages.dashboard',compact('user'));
    }

    public function register_view(Request $request)
    {      
        return view('providers::pages.auth.register');        
    }

    public function login_view(Request $request)
    {      
       
        return view('providers::pages.auth.login');        
    }


    public function checklogin(Request $request)
    {
      
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            if (auth()->guard('provider')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
            {                
                $user = auth()->guard('provider')->user();
                
                $url = '/providers/dashboard';
                
                return response()->json(['user' => $user,'url'=> $url,'success'=> true]);
            }
            else{
                return response()->json(['error' => 'Your username and password are wrong.']);
                // return back()->with('error','your username and password are wrong.');
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An unexpected error occurred.']);
        }
        
    }

    public function logout()
    {
        $user = Auth::guard('provider')->logout(); // 'web' is the default guard for web authentication
        return response()->json(['user' => $user,'success'=> true]);
    }

    public function registerPost(Request $request)
    {
       
        $this->validate($request, [
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            'email' => 'required|email|unique:providers,email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ]);
       
        $user = Provider::create([
            'name' => 'test',
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $otp = rand(100000, 999999); // Generate a random 6-digit OTP
        
        // Store OTP in the database
        // OTP::create([
        //     'user_id' => $user->id,
        //     'otp' => $otp,
        // ]);

        return response()->json([
            'success' => true,
            'user'=>$user,
            'redirect' => '/providers/otp-verify', // URL to redirect to
            'otp'=>$otp
        ]);
       
        
    }

    public function verify(Request $request)
    {
        // Validate the incoming request data
        // user_id =>  |exists:users,id
        // 'otp' => 'required|string|digits:6',
        $validatedData = $request->validate([
            'user_id' => 'required',
            'otp' => 'required|string',
        ]);
        
        // Find the user
        // $user = User::find($validatedData['user_id']);
        
        // // Find the OTP associated with the user
        // $otp = OTP::where('user_id', $user->id)->first();
        $otp = 12345;
       
        // Check if OTP matches
        try {
            if ($otp  == $validatedData['otp']) {
                // // OTP matched, mark the user as verified
                // // $user->update(['verified' => true]);
                
                // // Del  ete the OTP record from the database
                // $otp->delete();
                
                // Redirect the user to the dashboard or any other page
                
                return response()->json(['success'=> true]);
                
            } else {

                return response()->json(['error' => 'Invalid OTP. Please try again.']);
               
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An unexpected error occurred.']);
        }
        
    }
}
