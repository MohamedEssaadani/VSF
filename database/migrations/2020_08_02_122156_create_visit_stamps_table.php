<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitStampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_stamps', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('stamp')->unsigned();
            $table->foreign('stamp')
            ->references('id')
            ->on('stamps');
            
            $table->bigInteger('visit')->unsigned();
            $table->foreign('visit')
            ->references('id')
            ->on('visits');

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
        Schema::dropIfExists('visit_stamps');
    }
}
