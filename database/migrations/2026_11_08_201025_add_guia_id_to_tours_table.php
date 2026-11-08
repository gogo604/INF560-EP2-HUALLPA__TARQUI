<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Crear guia_id solamente si todavía no existe
        if (!Schema::hasColumn('tours', 'guia_id')) {
            Schema::table('tours', function (Blueprint $table) {
                $table->foreignId('guia_id')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('tours', 'guia_id')) {
            Schema::table('tours', function (Blueprint $table) {
                $table->dropForeign(['guia_id']);
                $table->dropColumn('guia_id');
            });
        }
    }
};
