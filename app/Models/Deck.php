<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];



    public function cards()
    {
        return $this->belongsToMany(Card::class);
    }



    public static function prepareDeckListEndpoint($element)
    {
        $list = $element->map(function ($item) {
            $item = [
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'cards' => Card::prepareCardListEndpoint($item->cards),
                'updated_at' => $item->updated_at,
                'created_at' => $item->created_at,
            ];
            return $item;
        });

        return $list;
    }

    public static function prepareDeckEndpoint($element)
    {
        $element = [
            'id' => $element->id,
            'name' => $element->name,
            'description' => $element->description,
            'cards' => Card::prepareCardListEndpoint($element->cards),
            'updated_at' => $element->updated_at,
            'created_at' => $element->created_at,
        ];

        return $element;
    }
}
