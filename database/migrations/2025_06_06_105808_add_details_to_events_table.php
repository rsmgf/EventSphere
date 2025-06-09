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
        $table->text('sk')->nullable(); 
        $table->string('pemateri')->nullable(); 
        $table->integer('harga')->default(0); 
    });
}

public function down()
{
    Schema::table('events', function (Blueprint $table) {
        $table->dropColumn(['sk', 'penyelenggara', 'harga']);
    });
}

};
