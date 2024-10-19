<?php

namespace App\Http\Controllers\Api\V1\Auth;

use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class CustomerAuthController extends Controller
{
    public function loginUser(Request $request)
    {
        
        try 
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ]);


            if ($validator->fails()) 
            {
                return response()->json(['errors' => Helpers::error_processor($validator)], 403);
            }

            $credentials = $request->only('email', 'password');
            // return $credentials;


            
            if (Auth::guard('web')->attempt($credentials)) 
            {

                $user = Auth::guard('web')->user();
                // return $user;
                
                if ($user) //&& Hash::check($request->password, $user->password)
                {
                    $token = $user->createToken('CustomerAuth')->accessToken;
                    $user->remember_token = $token;
                    $user->save();

                
                    return response()->json([
                        'token' => $token,
                        'user' => $user,
                    ], 200);
                } 
                else 
                {
                    Log::warning('User authenticated but not found in DB.');
                    return response()->json([
                        'errors' => [['code' => 'auth-001', 'message' => 'Unauthorized.']]
                    ], 401);
                }
            } 
            else 
            {
                return response()->json([
                    'errors' => [['code' => 'auth-001', 'message' => 'Unauthorizedddd.']]
                ], 401);
            }
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }




    public function viewProfile()
    {
        try 
        {
            
            $user = auth('user-api')->user();
    
           
            if (!$user) 
            {
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'User not authenticated.',
                ], 401);
            }

            return response()->json($user);
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'error' => 'An error occurred while fetching data.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    



    public function update(Request $request)
    {

        try 
        {
            
            $user = auth('user-api')->user();
    
            if (!$user) 
            {
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'User not authenticated',
                ], 401);
            }
    
           
            $request->validate([
                'f_name' => 'nullable|string|max:255',
                'l_name' => 'nullable|string|max:255',
                'password' => 'nullable|string|min:8', 
            ]);
    
          
            $changedFields = [];


            if ($request->filled('f_name') && $request->input('f_name') !== $user->f_name) 
            {
                $user->f_name = $request->input('f_name');
                $changedFields[] = 'f_name';
            }


            if ($request->filled('l_name') && $request->input('l_name') !== $user->l_name) 
            {
                $user->l_name = $request->input('l_name');
                $changedFields[] = 'l_name';
            }


            if ($request->filled('password')) 
            {
                $hashedPassword = Hash::make($request->input('password'));
                if ($hashedPassword !== $user->password) 
                {
                    $user->password = $hashedPassword;
                    $changedFields[] = 'password';
                }
            }


            if (empty($changedFields)) 
            {
                return response()->json(['message' => 'No new changes'], 200);
            }
    
            $user->save();
    
            return response()->json([ 
                'message' => 'User profile updated successfully',
                'changed_fields' => $changedFields]);
        } 
        catch (\Exception $e) 
        {
            return response()->json([
                'error' => 'An error occurred while updating user profile.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
