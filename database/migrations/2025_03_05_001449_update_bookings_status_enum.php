<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE bookings DROP CONSTRAINT IF EXISTS bookings_status_check");
        DB::statement("ALTER TABLE bookings DROP CONSTRAINT IF EXISTS bookings_status_check");
        DB::statement("ALTER TABLE bookings ADD CONSTRAINT bookings_status_check CHECK (status IN ('pending', 'accepted', 'rejected', 'confirmed'))");
    }

    public function down()
    {
        DB::statement("ALTER TABLE bookings DROP CONSTRAINT IF EXISTS bookings_status_check");
        DB::statement("ALTER TABLE bookings ADD CONSTRAINT bookings_status_check CHECK (status IN ('pending', 'accepted', 'rejected'))");
    }
};