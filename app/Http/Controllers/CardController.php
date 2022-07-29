<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Tag;

class CardController extends Controller
{

    public function index()
    {
        $allCards = Card::prepareCardListEndpoint(Card::all());
        return response()->json($allCards, 200);
    }


    public function store(Request $request)
    {
        //If the validation fails, the proper response is automatically be generated.
        $fields = $request->validate([
            'front_title' => 'required',
            'front_description' => 'required',
            'back_title' => 'required',
            'back_description' => 'required',
        ]);


        $response = [
            'message' => 'A new card was created'
        ];

        Card::create($fields);
        return response($response, 201);
    }


    public function show($id)
    {
        try {
            $card = Card::prepareCardEndpoint(Card::findOrFail($id));
            return response()->json($card, 200);
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
            'front_title' => 'required',
            'front_description' => 'required',
            'back_title' => 'required',
            'back_description' => 'required',
        ]);

        try {
            Card::findOrFail($id)->update($fields);

            $response = [
                'message' => 'The card was updated successfully'
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
            Card::findOrFail($id)->delete();

            $response = [
                'message' => 'The card was deleted successfully'
            ];

            return response($response, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response("", 204);
        } catch (\Throwable $th) {
            return response("Erro Interno", 500);
        }
    }

    public function addTag(Request $request)
    {
        $fields = $request->validate([
            'card_id' => 'required',
            'tag_id' => 'required',
        ]);

        try {
            $card = Card::findOrFail($fields['card_id']);
            $tag = Tag::findOrFail($fields['tag_id']);

            //return response()->json($tag, 200);
            //return response($tag->id);

            $card->tags()->attach($tag->id);

            $response = [
                'message' => 'The tag was added to the card'
            ];

            return response($response, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response("O elemento que você procura atualizar não existe", 204);
        } catch (\Throwable $th) {
            return response("Erro Interno", 500);
        }

        return response($response, 201);
    }


    public function removeTag(Request $request)
    {
        $fields = $request->validate([
            'card_id' => 'required',
            'tag_id' => 'required',
        ]);

        try {
            $card = Card::findOrFail($fields['card_id']);
            $tag = Tag::findOrFail($fields['tag_id']);

            //return response()->json($tag, 200);
            //return response($tag->id);

            $card->tags()->detach($tag->id);

            $response = [
                'message' => 'The tag was removed from card successfully'
            ];

            return response($response, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response("O elemento que você procura atualizar não existe", 204);
        } catch (\Throwable $th) {
            return response("Erro Interno", 500);
        }

        return response($response, 201);
    }
}
