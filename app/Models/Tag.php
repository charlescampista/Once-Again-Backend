<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];


    public function cards()
    {
        return $this->belongsToMany(Card::class, 'tag_card', 'tagId', 'cardId');
    }


    public static function prepareTagListEndpoint($element)
    {
        $list = $element->map(function ($item) {
            $item = [
                'id' => $item->id,
                'title' => $item->title,
            ];
            return $item;
        });

        return $list;
    }

    public static function prepareTagEndpoint($element)
    {
        $element = [
            'id' => $element->id,
            'title' => $element->title,
        ];

        return $element;
    }
}
