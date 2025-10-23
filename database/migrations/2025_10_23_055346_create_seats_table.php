<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('row');
            $table->unsignedInteger('col');
            $table->decimal('price', 8, 2);
            $table->unsignedBigInteger('hall_id')->index();
            $table->foreign('hall_id')->references('id')->on('halls')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['hall_id']);
            $table->dropIndex(['hall_id']);
        });
    }
};
