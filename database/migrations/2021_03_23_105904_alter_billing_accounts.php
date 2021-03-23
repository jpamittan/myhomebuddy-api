<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBillingAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billing_accounts', function (Blueprint $table) {
            $table->integer('mm')->unsigned()->nullable()->change();
            $table->integer('yy')->unsigned()->nullable()->change();
            $table->integer('cvc')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billing_accounts', function (Blueprint $table) {
            $table->integer('mm')->unsigned()->nullable(false)->change();
            $table->integer('yy')->unsigned()->nullable(false)->change();
            $table->integer('cvc')->unsigned()->nullable(false)->change();
        });
    }
}
