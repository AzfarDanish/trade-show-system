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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->unsignedBigInteger('exhibitor_id');
            $table->string('client_name');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->text('purpose');
            $table->enum('status', [
                'Pending',
                'Confirmed',
                'Completed',
                'Cancelled'
            ])->default('Pending');
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
        Schema::dropIfExists('appointments');
    }
};
