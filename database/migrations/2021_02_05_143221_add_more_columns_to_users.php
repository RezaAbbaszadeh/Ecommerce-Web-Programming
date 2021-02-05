<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->default("");
            $table->string('phone_number')->default('09156781234');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->date('birthday')->nullable();
            $table->string('national_id')->default('0');
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table->string('owner_name')->default("default");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('phone_number');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('birthday');
            $table->dropColumn('national_id');
        });

        Schema::table('sellers', function (Blueprint $table) {
            $table->dropColumn('owner_name');
        });
    }
}
