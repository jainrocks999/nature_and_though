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
         Schema::create('survey_config_tbl', function (Blueprint $table) {
            $table->id('id'); 
            $table->integer('user_id');
            $table->string('landing_id');
            $table->string('token');
            $table->string('response_id');
            $table->string('response_type');
            $table->string('landed_at');
            $table->string('submitted_at');
            $table->string('metadata');
            $table->string('hidden');
            $table->string('calculated');
            $table->string('answer');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('last_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_config_tbl');
    }
};
