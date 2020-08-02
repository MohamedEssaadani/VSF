<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_visits', function (Blueprint $table) {
            $table->id();

            $table->string('customer');
            $table->foreign('customer')
            ->references('matricule')
            ->on('customers');

            $table->bigInteger('visit')->unsigned();

            $table->foreign('visit')
            ->references('id')
            ->on('visits');
            
            $table->double('total');
            
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
        Schema::dropIfExists('customer_visits');
    }
}
