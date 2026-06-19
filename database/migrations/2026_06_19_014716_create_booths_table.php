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
        Schema::create('booths', function (Blueprint $table) {
            $table->id('booth_id');
            $table->unsignedBigInteger('exhibitor_id');
            $table->string('booth_number')->unique();
            $table->string('location');
            $table->timestamps();

            $table->foreign('exhibitor_id')
                ->references('exhibitor_id')
                ->on('exhibitors')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booths');
    }
};
