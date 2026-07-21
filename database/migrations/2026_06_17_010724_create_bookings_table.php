<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {

        Schema::create('bookings', function (Blueprint $table) {


            $table->id();



            /*
            |--------------------------------------------------------------------------
            | USER CONNECTION
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();



            /*
            |--------------------------------------------------------------------------
            | BOOKING INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->string('booking_id')
                  ->unique();



            /*
            |--------------------------------------------------------------------------
            | EVENT CONNECTION
            |--------------------------------------------------------------------------
            */

            $table->foreignId('event_id')
                  ->nullable()
                  ->constrained('events')
                  ->nullOnDelete();



            /*
            |--------------------------------------------------------------------------
            | CUSTOMER INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->string('first_name');

            $table->string('last_name');

            $table->string('full_name');

            $table->string('email');



            /*
            |--------------------------------------------------------------------------
            | CONTACT INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->string('country_code')
                  ->default('+63');


            $table->string('contact');



            /*
            |--------------------------------------------------------------------------
            | SCHEDULE
            |--------------------------------------------------------------------------
            */

            $table->dateTime('booking_datetime');

            $table->dateTime('end_datetime');



            /*
            |--------------------------------------------------------------------------
            | BOOKING DETAILS
            |--------------------------------------------------------------------------
            */

            $table->string('room_type');


            $table->integer('guests')
                  ->default(1);



            /*
            |--------------------------------------------------------------------------
            | EXTRA INFORMATION
            |--------------------------------------------------------------------------
            */

            $table->text('notes')
                  ->nullable();


            $table->string('receipt')
                  ->nullable();



            /*
            |--------------------------------------------------------------------------
            | BOOKING STATUS
            |--------------------------------------------------------------------------
            */

            $table->string('status')
                  ->default('pending');



            $table->timestamps();

        });

    }



    public function down(): void
    {

        Schema::dropIfExists('bookings');

    }

};