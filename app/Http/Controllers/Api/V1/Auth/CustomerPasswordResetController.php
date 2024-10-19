<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\PasswordReset;
use Carbon\Carbon;


class CustomerPasswordResetController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    // use ResetsPasswords;

    // /**
    //  * Where to redirect users after resetting their password.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::HOME;


    public function reset_password_request(Request $request)
    {
        
        try 
        {
            // return response()->json([
            //     'Request' => $request->all()], 200);



            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
            ]);

            if ($validator->fails()) 
            {
                return response()->json(['errors' => Helpers::error_processor($validator)], 403);
            }

           
          
            $user = auth('user-api')->user();
            //  return response()->json([
            //    'User' => $user], 200);
   
           if (!$user) 
           {
               return response()->json([
                   'error' => 'Unauthorized',
                   'message' => 'User not authenticated',
               ], 401);
           }
           

            if ($user->email !== $request->email) 
            {
                return response()->json(['errors' => [
                    ['code' => 'auth-001', 'message' => 'Unauthorized.']
                ]], 401);
            }

           

            // Security checks
            $count = PasswordReset::where('email', $user->email)->where('created_at', '>=', \Carbon\Carbon::now()->subHour())->count();

            if ($count > 20)
            {
                return response()->json(['errors' => [
                    ['code' => 'invalid', 'message' => 'You made a lot of requests! Try again later.']
                ]], 400);
            }



            $count =PasswordReset:: where('email', $user->email)->where('created_at', '>=', Carbon::today())->count();

            if ($count > 5) 
            {
                return response()->json(['errors' => [
                    ['code' => 'invalid', 'message' => 'You made a lot of requests! Try again later.']
                ]], 400);
            }
            //End



            $token = rand(1000, 9999);
            PasswordReset:: insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => now(),
            ]);

            Mail::to($user->email)->send(new \App\Mail\PasswordResetMail($token));

            return response()->json(['message' => 'Email sent successfully.'], 200);
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'errors' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }





    public function verify_token(Request $request)
    {
        try 
        {
            $data = PasswordReset:: where(['token' => $request['reset_token'],'email'=>$request['email']])->first();
            // return response()->json(['data' => $data], 200);

            if (isset($data)) 
            {
                return response()->json(['message'=>"Token found, you can proceed"], 200);
            } 
            else 
            {
                return response()->json(['errors' => [
                    ['code' => 'invalid', 'message' => 'Invalid token.']
                ]], 400);
            }
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'errors' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }





    public function reset_password_submit(Request $request)
    {
        try 
        {
            $data = PasswordReset:: where(['token' => $request['reset_token']])->first();
            // return response()->json(['data' => $data], 200);
            


            if ($data !== null) 
            {
                if ($request['password'] == $request['confirm_password']) 
                {
                    User:: where('email', $data->email)->update([
                        'password' => bcrypt($request['confirm_password'])
                    ]);
                    PasswordReset:: where('token', $request['reset_token'])->delete();

                    return response()->json(['message' => 'Password changed successfully.'], 200);
                } 
                else 
                {
                    return response()->json(['errors' => [
                        ['code' => 'mismatch', 'message' => 'Password did not match!']
                    ]], 401);
                }
            } 
            else 
            {
                return response()->json(['errors' => [
                    ['code' => 'invalid', 'message' => 'Invalid token.']
                ]], 400);
            }
        }
    
        catch (\Exception $e) 
        {
            return response()->json([
                'errors' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

}
