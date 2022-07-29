<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deck;
use App\Models\Card;

class DeckController extends Controller
{
    public function index()
    {
        $allDecks = Deck::prepareDeckListEndpoint(Deck::all());
        return response()->json($allDecks, 200);
    }


    public function store(Request $request)
    {
        //If the validation fails, the proper response is automatically be generated.
        $fields = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);


        $response = [
            'message' => 'A new deck was created successfully'
        ];

        Deck::create($fields);
        return response($response, 201);
    }


    public function show($id)
    {
        try {
            $deck = Deck::prepareDeckEndpoint(Deck::findOrFail($id));
            return response()->json($deck, 200);
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
            'name' => 'required',
            'description' => 'required',
        ]);

        try {
            Deck::findOrFail($id)->update($fields);

            $response = [
                'message' => 'The deck was updated successfully'
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
            Deck::findOrFail($id)->delete();

            $response = [
                'message' => 'The deck was deleted successfully'
            ];

            return response($response, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response("", 204);
        } catch (\Throwable $th) {
            return response("Erro Interno", 500);
        }
    }


    public function addCard(Request $request)
    {
        $fields = $request->validate([
            'card_id' => 'required',
            'deck_id' => 'required',
        ]);

        try {
            $card = Card::findOrFail($fields['card_id']);
            $deck = Deck::findOrFail($fields['deck_id']);

            $deck->cards()->attach($card->id);

            $response = [
                'message' => 'The card was added to the deck'
            ];

            return response($response, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response("O elemento que você procura atualizar não existe", 204);
        } catch (\Throwable $th) {
            return response("Erro Interno", 500);
        }

        return response($response, 201);
    }


    public function removeCard(Request $request)
    {
        $fields = $request->validate([
            'card_id' => 'required',
            'deck_id' => 'required',
        ]);

        try {
            $card = Card::findOrFail($fields['card_id']);
            $deck = Deck::findOrFail($fields['deck_id']);


            $deck->cards()->detach($card->id);

            $response = [
                'message' => 'The card was removed from deck successfully'
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
