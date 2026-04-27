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
        Schema::table('perusahaans', function (Blueprint $table) {
            $table->enum('status_verifikasi', ['pending', 'verified', 'rejected'])->default('pending')->after('foto_profil');
            $table->text('alasan_penolakan')->nullable()->after('status_verifikasi');
            $table->unsignedBigInteger('verified_by')->nullable()->after('alasan_penolakan');
            $table->timestamp('verified_at')->nullable()->after('verified_by');
        });
    }

    public function down(): void
    {
        Schema::table('perusahaans', function (Blueprint $table) {
            $table->dropColumn(['status_verifikasi', 'alasan_penolakan', 'verified_by', 'verified_at']);
        });
    }
};
