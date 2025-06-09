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
        Schema::rename('data_ortu', 'data_ortus');
    }

    public function down(): void
    {
        Schema::rename('data_ortus', 'data_ortu');
    }
};
