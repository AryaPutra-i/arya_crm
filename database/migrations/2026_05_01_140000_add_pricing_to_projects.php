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
        Schema::table('projects', function (Blueprint $table) {
            $table->decimal('total_harga', 12, 2)->default(0)->after('lead_id');
            $table->decimal('total_harga_negosiasi', 12, 2)->nullable()->after('total_harga');
            $table->enum('harga_status', ['pending', 'approved', 'rejected'])->default('pending')->after('total_harga_negosiasi');
            $table->text('harga_notes')->nullable()->after('harga_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['total_harga', 'total_harga_negosiasi', 'harga_status', 'harga_notes']);
        });
    }
};
