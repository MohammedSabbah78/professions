<?php

namespace App\Http\Controllers;

use App\Mail\UserSendNewPasswordEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use Str;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::withCount('permissions')->get();
        return response()->view('cms.users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'mobile' => 'required|numeric|min:3|unique:users,mobile',
            'email' => 'required|email|unique:users,email',
            'image' => 'required|image|max:2048|mimes:jpg,png',
        ]);


        if (!$validator->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');


            $randomPassword = Str::random(10);
            $user->password = Hash::make($randomPassword);

            if ($request->hasFile('image')) {
                $imageName = time() . "_user_image" . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/', $imageName);
                $user->image = 'images/' . $imageName;
            }

            $isSaved = $user->save();
            if ($isSaved) {
                Mail::to($user)->send(new UserSendNewPasswordEmail($user, $randomPassword));
            }
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        return response()->view('cms.users.update', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|numeric|min:3' . $user->id,
            'image' => 'nullable', 'image|max:2048|mimes:jpg,png',
        ]);

        if (!$validator->fails()) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->mobile = $request->input('mobile');

            if ($request->hasFile('image')) {
                Storage::delete($user->image);

                $imageName = time() . "_user_image" . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/', $imageName);
                $user->image = 'images/' . $imageName;
            }
            $isSaved = $user->save();
            return response()->json(
                ['message' => $isSaved ? 'Updated' : 'Failed'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ["message" => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $deleted = $user->delete();
        if ($deleted) {

            Storage::delete($user->image);
        }
        return response()->json(
            ['message' => $deleted ? 'Deleted!' : 'Failed'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Show the form for editing the specified resource permssions.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function editUserPermission(Request $request, User $user)
    {

        $permissions = Permission::where('guard_name', '=', 'user')->orWhere('guard_name', '=', 'user-api')->get();
        $userPermissions = $user->permissions;


        foreach ($permissions as $permission) {
            $permission->setAttribute('assigned', false);

            foreach ($userPermissions as $userPermission) {
                if ($userPermission->id == $permission->id) {
                    $permission->setAttribute('assigned', true);
                }
            }
        }


        return response()->view('cms.users.user-permissions', ['users' => $user, 'permissions' => $permissions]);
    }
    /**
     * Update the specified resource permissions in storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateUserPermission(Request $request, User $user)
    {
        $validator = Validator($request->all(), [
            'permission_id' => 'required|numeric|exists:permissions,id',
        ]);
        if (!$validator->fails()) {

            $permission = Permission::findOrFail($request->input('permission_id'));
            $user->hasPermissionTo($permission)
                ? $user->revokePermissionTo($permission)
                : $user->givePermissionTo($permission);

            return response()->json(
                ["message" => "Permissions Updated Successfully"],
                Response::HTTP_OK
            );
        } else {
            return response()->json(
                ["message" => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
