<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visites', function (Blueprint $table) {
            $table->id();
            //Mutation or periodic control
            $table->string('type');
            //visite price
            $table->decimal('price');
            //tva
            $table->integer('tva');
            //timbres
            $table->decimal('narfa');
            $table->decimal('kitonse');
            $table->decimal('local');
            //total to pay
            $table->decimal('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visites');
    }
}
