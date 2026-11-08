<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE tours RENAME COLUMN "guia_Id" TO guia_id');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE tours RENAME COLUMN guia_id TO "guia_Id"');
    }
};
