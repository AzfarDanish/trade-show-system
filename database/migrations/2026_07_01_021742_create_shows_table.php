<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->id('show_id');
            $table->string('name');
            $table->enum('status', ['active', 'ended'])->default('active');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('poster')->nullable();
            $table->timestamps();
        });

        Schema::table('booths', function (Blueprint $table) {
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
        });

        Schema::dropIfExists('shows');
    }
};
