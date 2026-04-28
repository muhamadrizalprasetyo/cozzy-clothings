<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->string('shop_name')->default('Cozzy.co');
            $table->string('contact_wa')->default('08123456789');
        });
    }

    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn(['shop_name', 'contact_wa']);
        });
    }
};
