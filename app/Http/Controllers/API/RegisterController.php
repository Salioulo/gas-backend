<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class RegisterController extends Controller
{
    /**
    * Register api
    *
    * @return \Illuminate\Http\Response
    */

    /** get all users */

    public function index()
    {
        $users = DB::table('users');

        if($users) {
            return response()->json([
                'result' => 200,
                'message' => $users,
            ], 200);
        } else {
            return response()->json([
                'result' => 500,
                'message' => 'Erreur récupération user!'
            ], 500);

        }

       // return $this->sendResponse($users, 'Displaying all users data');
    }

    public function register(Request $request)
    {
        try {
            $validate = Validator::make($request->all(),[
                'cni' => 'required',
                'prenom' => 'required',
                'nom' => 'required',
                'datenais' => 'required',
                'lieunais' => 'required',
                'telephone' => 'required',
                'email' => 'required|email|unique:users,email',
                'adresse' => 'required',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]);

            if($validate->fails()){
                return response()->json([
                    'result' => false,
                    'message' => 'validation error',
                    'errors' => $validate->errors()
                ], 401);
            }

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['data'] =  $user->prenom;
            //return $this->sendResponse($success, 'User register successfully.');

            if($user) {
                return response()->json([
                    'result' => 200,
                    'message' => $success,
                ], 200);
            } else {
                return response()->json([
                    'result' => 500,
                    'message' => 'Inscription échouée!'
                ], 500);

            }

        } catch (\Throwable $th) {
            return response()->json([
                'result' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
    * Login api
    *
    * @return \Illuminate\Http\Response
    */

    public function login(Request $request)
    {

            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'result' => false,
                    'message' => 'validation error',
                    'err' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'result' => false,
                    'message' => 'Erreur email ou password.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'result' => true,
                'message' => 'User Logged In Successfully',
                'user' => $user,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);


    }

}


