<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'front_title',
        'front_description',
        'back_title',
        'back_description',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_card', 'cardId', 'tagId');
    }

    public function decks()
    {
        return $this->belongsToMany(Deck::class);
    }



    public static function prepareCardListEndpoint($element)
    {
        $list = $element->map(function ($item) {
            $item = [
                'id' => $item->id,
                'front_title' => $item->front_title,
                'front_description' => $item->front_description,
                'back_title' => $item->back_title,
                'back_description' => $item->back_description,
                'tags' => Tag::prepareTagListEndpoint($item->tags),
                'updated_at' => $item->updated_at,
                'created_at' => $item->created_at,
            ];
            return $item;
        });

        return $list;
    }

    public static function prepareCardEndpoint($element)
    {
        $element = [
            'id' => $element->id,
            'front_title' => $element->front_title,
            'front_description' => $element->front_description,
            'back_title' => $element->back_title,
            'back_description' => $element->back_description,
            'tags' => Tag::prepareTagListEndpoint($element->tags),
            'updated_at' => $element->updated_at,
            'created_at' => $element->created_at,
        ];

        return $element;
    }
}
