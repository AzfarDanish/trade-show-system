<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('exhibitors', function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive'])->default('inactive')->after('phone_number');
        });

        DB::table('exhibitors')->update(['status' => 'active']);
    }

    public function down(): void
    {
        Schema::table('exhibitors', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};