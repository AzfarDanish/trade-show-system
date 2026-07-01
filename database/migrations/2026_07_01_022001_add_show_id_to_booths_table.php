<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('booths', function (Blueprint $table) {
            $table->unsignedBigInteger('show_id')->nullable()->after('exhibitor_id');

            $table->foreign('show_id')
                ->references('show_id')
                ->on('shows')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('booths', function (Blueprint $table) {
            $table->dropForeign(['show_id']);
            $table->dropColumn('show_id');
        });
    }
};