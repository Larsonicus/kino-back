<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropIndex(['city_id']);
            $table->dropColumn('city_id');

            $table->unsignedBigInteger('cinema_id')->index();
            $table->foreign('cinema_id')->references('id')->on('cinemas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            $table->dropForeign(['cinema_id']);
            $table->dropIndex(['cinema_id']);
            $table->dropColumn('cinema_id');

            $table->unsignedBigInteger('city_id')->index();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
}
};
