<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cinemas', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('working_hours')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('cinemas', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'contact_number',
                'working_hours',
            ]);
        });
    }
};
