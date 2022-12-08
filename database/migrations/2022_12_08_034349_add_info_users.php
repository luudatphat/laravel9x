<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('shop_id')->nullable(false)->unique();
            $table->string('domain')->nullable();
            $table->string('name')->nullable();
            $table->string('shop_phone')->nullable();
            $table->boolean('shop_status')->nullable();
            $table->string('shop_country')->nullable();
            $table->string('shop_owner')->nullable();
            $table->string('plan_name')->nullable();
            $table->string('app_plan')->nullable();
            $table->string('currency')->nullable();
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
            $table->dropColumn([
                'shop_id',
                'domain',
                'name',
                'shop_phone',
                'shop_status',
                'shop_country',
                'shop_owner',
                'plan_name',
                'app_plan',
                'currency'
            ]);
        });
    }
};
