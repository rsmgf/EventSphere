<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('events', function (Blueprint $table) {
        $table->time('start_time')->default('00:00:00');
        $table->time('end_time')->default('00:00:00');
    });
}

public function down()
{
    Schema::table('events', function (Blueprint $table) {
        $table->dropColumn(['start_time', 'end_time']);
    });
}

};
