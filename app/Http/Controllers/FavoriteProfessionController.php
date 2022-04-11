<?php

namespace App\Http\Controllers;

use App\Models\FavoriteProfession;
use App\Models\Profession;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\Response;

class FavoriteProfessionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(FavoriteProfession::class, 'favoriteProfession');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth('user')->check()) {
            // $favoriteProfessions = FavoriteProfession::with(['profession'])->get();
            $favoriteProfessions = $request->user()->favoriteProfessions;

            return response()->view('cms.profession.favoriteProfessions.index', ['favoriteProfessions' => $favoriteProfessions]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.profession.favoriteProfessions.create');
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
            'id' => 'required|integer|exists:professions,id',
        ]);

        if (!$validator->fails()) {

            $profession = Profession::find($request->input('id'));
            if (!is_null($profession)) {
                $user = auth('user')->user();
                if (!$user->favoriteProfessions()->where('profession_id', $profession->id)->exists()) {
                    $favoriteProfessions = new FavoriteProfession();
                    $favoriteProfessions->profession_id = $profession->id;
                    $isSaved = $user->favoriteProfessions()->save($favoriteProfessions);
                } else {
                    return response()->json(
                        ['message' =>  'Favorite is Added!!'],
                        Response::HTTP_BAD_REQUEST
                    );
                    $isSaved = $user->favoriteProfessions()->delete($profession);
                }
                return response()->json(
                    ['message' => $isSaved ? 'Created' : 'Failed'],
                    $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
                );
            } else {
                return response()->json(
                    ['message' =>  'NOT FOUND'],
                    Response::HTTP_BAD_REQUEST
                );
            }
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
     * @param  \App\Models\FavoriteProfession  $favoriteProfession
     * @return \Illuminate\Http\Response
     */
    public function show(FavoriteProfession $favoriteProfession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FavoriteProfession  $favoriteProfession
     * @return \Illuminate\Http\Response
     */
    public function edit(FavoriteProfession $favoriteProfession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FavoriteProfession  $favoriteProfession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FavoriteProfession $favoriteProfession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FavoriteProfession  $favoriteProfession
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavoriteProfession $favoriteProfession)
    {
        $deleted = $favoriteProfession->delete();
        return response()->json(
            ['message' => $deleted ? 'Deleted!' : 'Failed'],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
