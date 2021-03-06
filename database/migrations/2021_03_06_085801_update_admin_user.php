<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')
            ->where('id', 1)
            ->update([
                "type" => "Admin",
                "is_activated" => 1
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')
            ->where('id', 1)
            ->update([
                "type" => null,
                "is_activated" => 0
            ]
        );
    }
}
