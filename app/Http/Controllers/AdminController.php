<?php

namespace App\Http\Controllers;

use App\Mail\AdminSendNewPasswordEmail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Str;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Admin::class, 'admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = Admin::with('roles')->get();
        return response()->view('cms.admins.index', ['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $role = Role::where('guard_name', '=', 'admin')->get();
        return response()->view('cms.admins.create', ['roles' => $role]);
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
            'mobile' => 'required|numeric|min:3|unique:admins,mobile',
            'email' => 'required|email|unique:admins,email',
            'image' => 'required|image|max:2048|mimes:jpg,png',
        ]);


        if (!$validator->fails()) {
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->mobile = $request->input('mobile');

            // $randomPassword = Str::random(10);
            // $admin->password = Hash::make($randomPassword);
            $randomPassword = Str::random(10);
            $admin->password = Hash::make($randomPassword);

            if ($request->hasFile('image')) {
                $imageName = time() . "_admin_image" . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/', $imageName);
                $admin->image = 'images/' . $imageName;
            }

            $isSaved = $admin->save();
            if ($isSaved) {
                $admin->assignRole(Role::findOrFail($request->input('role_id')));
                Mail::to($admin)->send(new AdminSendNewPasswordEmail($admin, $randomPassword));
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
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(admin $admin)
    {
        $role = Role::where('guard_name', '=', 'admin')->get();
        $adminRole = $admin->roles[0];
        return response()->view('cms.admins.update', ['admin' => $admin, 'roles' => $role, 'adminRoles' => $adminRole]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, admin $admin)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'mobile' => 'required|numeric|min:3' . $admin->id,
            'image' => 'nullable', 'image|max:2048|mimes:jpg,png',
        ]);

        if (!$validator->fails()) {
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->mobile = $request->input('mobile');

            if ($request->hasFile('image')) {
                Storage::delete($admin->image);

                $imageName = time() . "_admin_image" . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/admins', $imageName);
                $admin->image = 'images/' . $imageName;
            }
            $isSaved = $admin->save();
            if ($isSaved) $admin->syncRoles(Role::findOrFail($request->input('role_id')));

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
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(admin $admin)
    {
        //
        if (auth('admin')->id() != $admin->id) {
            $deleted = $admin->delete();
            if ($deleted) {

                Storage::delete($admin->image);
            }
            return response()->json(
                ['message' => $deleted ? 'Deleted!' : 'Failed'],
                $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' =>  'Can\'t Delete Your Self'],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
