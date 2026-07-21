<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        // room_type already exists in create_bookings_table
    }


    public function down(): void
    {
        // nothing to rollback
    }

};