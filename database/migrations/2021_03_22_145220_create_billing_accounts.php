<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_accounts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('account_type');
            $table->string('card_no');
            $table->integer('mm');
            $table->integer('yy');
            $table->integer('cvc');
            $table->string('account_name');
            $table->string('address_line_a');
            $table->string('address_line_b');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('country');
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
        Schema::dropIfExists('billing_accounts');
    }
}
