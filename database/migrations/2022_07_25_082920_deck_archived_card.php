<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deck_archivedcard', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deckId');
            $table->unsignedBigInteger('archivedcardId');
            $table->timestamps();


            $table->foreign('deckId')
                ->references('id')
                ->on('decks')
                ->onDelete('cascade');
            $table->foreign('archivedcardId')
                ->references('id')
                ->on('cards')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deck_archivedcard');
    }
};
