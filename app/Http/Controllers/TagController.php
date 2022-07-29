<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $allTags = Tag::all();
        return response()->json($allTags, 200);
    }


    public function store(Request $request)
    {
        //If the validation fails, the proper response is automatically be generated.
        $fields = $request->validate([
            'title' => 'required',
        ]);


        $response = [
            'message' => 'A new tag was created'
        ];

        Tag::create($fields);
        return response($response, 201);
    }


    public function show($id)
    {
        try {
            $tag = Tag::findOrFail($id);
            return response()->json($tag, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response("", 204);
        } catch (\Throwable $th) {
            return response("Erro Interno", 500);
        }
    }

    public function edit(Request $request, $id)
    {
        //If the validation fails, the proper response is automatically be generated.
        $fields = $request->validate([
            'title' => 'required',
        ]);

        try {
            Tag::findOrFail($id)->update($fields);

            $response = [
                'message' => 'The tag was updated successfully'
            ];

            return response($response, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response("O elemento que você procura atualizar não existe", 204);
        } catch (\Throwable $th) {
            return response("Erro Interno", 500);
        }
    }


    public function destroy($id)
    {
        try {
            Tag::findOrFail($id)->delete();

            $response = [
                'message' => 'The tag was deleted successfully'
            ];

            return response($response, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response("", 204);
        } catch (\Throwable $th) {
            return response("Erro Interno", 500);
        }
    }
}
