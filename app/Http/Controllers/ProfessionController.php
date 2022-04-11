<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Profession;
use App\Models\SubCategory;
use App\Notifications\NewProfessionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ProfessionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Profession::class, 'profession');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $professions = Profession::with(['subCategory'])->get();
        $categories = Category::get();

        return response()->view('cms.profession.index', ['professions' => $professions, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $subCategories = SubCategory::where('status', '=', true)->get();
        return response()->view('cms.profession.create', ['subCategories' => $subCategories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:10',
            'gender' => 'required|string|in:M,F',
            'mobile' => 'required|string|min:3|unique:professions,mobile',
            'email' => 'required|email|unique:professions,email',
            'location' => 'required|string|min:3',
            'status' => 'nullable|boolean',
            'age' => 'required|numeric',
            'specialization' => 'string|min:3',
            'subCategory_id' => 'required|numeric|exists:sub_categories,id',
            'image' => 'required|image|max:2048|mimes:jpg,png|dimensions:min_width=1920,min_height=1200,max_width=1920,max_height=1200',
        ]);


        if (!$validator->fails()) {
            $profession = new Profession();

            $profession->name = $request->input('name');
            $profession->description = $request->input('description');
            $profession->gender = $request->input('gender');

            $profession->mobile = $request->input('mobile');
            $profession->email = $request->input('email');
            $profession->location = $request->input('location');
            $profession->status = $request->input('status');
            $profession->age = $request->input('age');
            $profession->specialization = $request->input('specialization');
            $profession->sub_category_id = $request->input('subCategory_id');



            if ($request->hasFile('image')) {
                $imageName = time() . "_profession_image" . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/', $imageName);
                $profession->image = 'images/' . $imageName;
            }

            $isSaved = $profession->save();
            if ($isSaved) {
                $admin = Admin::whereHas('roles', function ($query) {
                    $query->where('name', '=', 'Super-Admin');
                })->get();

                Notification::send($admin, new NewProfessionNotification($profession));
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
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function show(Profession $profession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function edit(Profession $profession)
    {
        $subCategories = SubCategory::where('status', '=', true)->get();
        return response()->view('cms.profession.update', ['subCategories' => $subCategories, 'professions' => $profession]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profession $profession)
    {
        $validator = Validator($request->all(), [

            'name' => 'required|string|min:3',
            'description' => 'required|string|min:10',
            'gender' => 'required|string|in:M,F',
            'mobile' => 'required|string|min:3|unique:professions,mobile,' . $profession->id,
            'email' => 'required|email|unique:professions,email,' . $profession->id,
            'location' => 'required|string|min:3',
            'status' => 'nullable|boolean',
            'age' => 'required|numeric',
            'specialization' => 'string|min:3',
            'subCategory_id' => 'required|numeric|exists:sub_categories,id',
            'image' => 'nullable|', 'image|max:2048|mimes:jpg,png|dimensions:min_width=1920,min_height=1200,max_width=1920,max_height=1200',


        ]);

        if (!$validator->fails()) {


            $profession->name = $request->input('name');
            $profession->description = $request->input('description');
            $profession->gender = $request->input('gender');

            $profession->mobile = $request->input('mobile');
            $profession->email = $request->input('email');
            $profession->location = $request->input('location');
            $profession->status = $request->input('status');
            $profession->age = $request->input('age');
            $profession->specialization = $request->input('specialization');
            $profession->sub_category_id = $request->input('subCategory_id');



            if ($request->hasFile('image')) {
                Storage::delete($profession->image);

                $imageName = time() . "_profession_image" . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/', $imageName);
                $profession->image = 'images/' . $imageName;
            }
            $isSaved = $profession->save();

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
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profession $profession)
    {
        $deleted = $profession->delete();
        if ($deleted) {

            Storage::delete($profession->image);
        }
        return response()->json(
            ['message' => $deleted ? 'Deleted!' : 'Failed'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
