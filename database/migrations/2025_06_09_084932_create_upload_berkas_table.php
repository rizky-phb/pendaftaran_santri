<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('upload_berkas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('berkas_fc_sttb')->nullable();
            $table->string('berkas_skhun')->nullable();
            $table->string('berkas_pas_foto')->nullable();
            $table->string('berkas_akte_kelahiran')->nullable();
            $table->string('berkas_blangko_pendaftaran')->nullable();
            $table->string('berkas_nisn')->nullable();
            $table->string('berkas_kartu_keluarga')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('upload_berkas');
    }
};
