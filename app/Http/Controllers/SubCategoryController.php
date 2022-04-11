<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(SubCategory::class, 'subCategory');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $subCategories = SubCategory::with(['category'])->withCount('professions')->get();
        return response()->view('cms.subCategories.index', ['subCategories' => $subCategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::where('status', '=', true)->get();
        return response()->view('cms.subCategories.create', ['categories' => $categories]);
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
            'title' => 'required|string|min:3|unique:sub_categories,title',
            'description' => 'required|string|min:10',
            'category_id' => 'required|numeric|exists:categories,id',
            'status' => 'nullable|boolean',
            'image' => 'required|image|max:2048|mimes:jpg,png',
        ]);


        if (!$validator->fails()) {
            $subCategory = new SubCategory();
            $subCategory->title = $request->input('title');
            $subCategory->description = $request->input('description');
            $subCategory->category_id = $request->input('category_id');

            $subCategory->status = $request->input('status');


            if ($request->hasFile('image')) {
                $imageName = time() . "_subCategory_image" . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/', $imageName);
                $subCategory->image = 'images/' . $imageName;
            }

            $isSaved = $subCategory->save();
            // if ($isSaved) {
            //     Mail::to($category)->send(new categorySendNewPasswordEmail($category, $randomPassword));
            // }
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
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::where('status', '=', true)->get();
        return response()->view('cms.subCategories.update', ['categories' => $categories, 'subCategory' => $subCategory]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $validator = Validator($request->all(), [
            'title' => 'required|string|unique:sub_categories,title,' . $subCategory->id,
            'description' => 'required|string|min:10',
            'category_id' => 'required|numeric|exists:categories,id',
            'status' => 'nullable|boolean',
            'image' => 'nullable', 'image|max:2048|mimes:jpg,png',
        ]);

        if (!$validator->fails()) {
            $subCategory->title = $request->input('title');
            $subCategory->description = $request->input('description');
            $subCategory->category_id = $request->input('category_id');

            $subCategory->status = $request->input('status');

            if ($request->hasFile('image')) {
                Storage::delete($subCategory->image);

                $imageName = time() . "_subCategory_image" . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/', $imageName);
                $subCategory->image = 'images/' . $imageName;
            }
            $isSaved = $subCategory->save();
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
     * @param  \App\Models\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $deleted = $subCategory->delete();
        if ($deleted) {

            Storage::delete($subCategory->image);
        }
        return response()->json(
            ['message' => $deleted ? 'Deleted!' : 'Failed'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
