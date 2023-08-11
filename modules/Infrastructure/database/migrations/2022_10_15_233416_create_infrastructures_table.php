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
        Schema::create('infrastructures', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('file_pdf')->nullable();
            $table->string('equipment')->nullable();
            $table->string('drafter')->nullable();
            $table->string('revisi')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('progress')->nullable();
            $table->uuid('user_create')->nullable();
            $table->string('nama_draw')->nullable();
            $table->string('no_draw')->nullable();
            $table->string('unit')->nullable();
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
        Schema::dropIfExists('infrastructures');
    }
};
