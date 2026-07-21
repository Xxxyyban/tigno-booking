<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {

            $table->id();


            // EVENT INFORMATION
            $table->string('name');

            $table->text('description')
                  ->nullable();


            // LOCATION
            $table->string('location');



            // DATE & TIME
            $table->dateTime('start_date');

            $table->dateTime('end_date');



            // EVENT DETAILS
            $table->integer('capacity');

            $table->decimal('price', 10, 2)
                  ->default(0);



            // STATUS
            $table->string('status')
                  ->default('upcoming');



            // CATEGORY
            $table->string('category')
                  ->nullable();



            // ORGANIZER
            $table->string('organizer')
                  ->nullable();



            // IMAGE
            $table->string('image')
                  ->nullable();



            $table->timestamps();

        });
    }



    public function down(): void
    {
        Schema::dropIfExists('events');
    }

};