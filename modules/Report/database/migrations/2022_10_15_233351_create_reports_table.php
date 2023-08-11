<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            
            $table->uuid('id')->primary();
            $table->string('tanggal_input')->nullable();
            $table->string('tanggal_mulai')->nullable();
            $table->string('show_status')->nullable();
            $table->string('unit')->nullable();            
            $table->string('equipment')->nullable();
            $table->string('program_kerja')->nullable();
            $table->longText('keterangan_pekerjaan')->nullable();
            $table->string('status_pekerjaan')->nullable();
            $table->string('progress')->nullable();
            $table->string('target')->nullable();
            $table->string('wo_number')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('scope_1')->nullable();
            $table->string('scope_2')->nullable();
            $table->string('pic')->nullable();
            $table->string('prioritas')->nullable();
            $table->json('upload_foto')->nullable();
            $table->json('upload_document')->nullable();
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
};
