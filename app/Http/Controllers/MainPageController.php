<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Profession;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    //
    public function showMainPage()
    {
        if (auth('admin')->check()) {
            $categoriesCount = Category::count();
            $subCategoriesCount = SubCategory::count();
            $professionsCount = Profession::count();
            $userCount = User::count();

            $users = User::all();

            $admins = Admin::all();

            $subCategories = SubCategory::with(['category'])->withCount('professions')->get();

            $categories = Category::withCount('subCategories')->get();


            $professions = Profession::with(['subCategory'])->get();

            return response()->view('cms.dashboard', [
                'categoriesCount' => $categoriesCount,
                'subCategoriesCount' => $subCategoriesCount,
                'professionsCount' => $professionsCount,
                'userCount' => $userCount,
                'users' => $users,
                'admins' => $admins,
                'subCategories' => $subCategories,
                'categories' => $categories,
                'professions' => $professions,
            ]);
        } else {

            $professions = Profession::with(['subCategory'])->get();
            $categories = Category::get();

            return response()->view('cms.profession.index', ['professions' => $professions, 'categories' => $categories]);
        }
    }
}
