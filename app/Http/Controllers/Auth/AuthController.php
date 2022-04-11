<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function showLoginView(Request $request)
    {

        $request->merge(['guard' => $request->guard]);

        $validator = Validator(['guard' => $request->guard], [
            'guard' => 'required|string|in:admin,user'
        ]);
        $request->session()->put('guard', $request->input('guard'));


        if (!$validator->fails()) {
            return response()->view('auth.login');
        } else {
            abort(Response::HTTP_NOT_FOUND, 'The Page Not Found');
        }
    }
    public function login(Request $request)
    {

        $validator = Validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:3',
            'remember' => 'required|boolean'
        ]);

        $guard = session()->get('guard');
        if (!$validator->fails()) {

            $credentials = ['email' => $request->input('email'), 'password' => $request->input('password'),];
            if (Auth::guard($guard)->attempt($credentials, $request->input('remember'))) {
                return response()->json(
                    ['message' => 'Login Success'],
                    Response::HTTP_OK
                );
            } else {
                return response()->json(
                    ['message' => 'Login Failed,Check login credentials'],
                    Response::HTTP_BAD_REQUEST
                );
            }
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }











    public function showRegisterView()
    {
        return response()->view('auth.register');
    }
    public function register(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|unique:users,mobile',
            'password' => 'required|string|min:3',
            'image' => 'required|image|max:2048|mimes:jpg,png',


        ]);
        if (!$validator->fails()) {
            $user = new User();
            $user->email = $request->input('email');
            $user->name = $request->input('name');
            $user->mobile = $request->input('mobile');
            $user->password = Hash::make($request->input('password'));


            if ($request->hasFile('image')) {
                $imageName = time() . "_user_image" . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/', $imageName);
                $user->image = 'images/' . $imageName;
            }

            $isSaved = $user->save();
            return response()->json(
                ['message' => $isSaved ? 'Created' : 'Failed'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ["message" => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }







    public function logout(Request $request)
    {
        $guard = session('guard');
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('auth.login', $guard);
    }

    public function editPassword()
    {
        return response()->view('auth.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $guard = auth('admin')->check() ? 'admin' : 'user';
        $validator = Validator($request->all(), [
            'password' => 'required|current_password:' . $guard,
            'new_password' => ['required', 'confirmed', Password::min(8)->letters()->symbols()->numbers()->mixedCase()->uncompromised()],

        ]);
        if (!$validator->fails()) {
            $user = $request->user();
            $user->forceFill(
                ['password' => Hash::make($request->input('new_password'))]
            );
            $isSaved = $user->save();

            return response()->json(
                ['message' => $isSaved ? 'Updated successfully' : 'Updated Failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ["message" => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
