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
        Schema::create('typeform_responses', function (Blueprint $table) {
            $table->id();
            $table->string('response_id');
            $table->string('response_type');
            $table->string('form_id');
            $table->string('form_type');
            $table->string('form_title');
            $table->string('metadata')->nullable();
            $table->string('hidden')->nullable();
            $table->string('calculated')->nullable();
            $table->string('answers')->nullable();
            $table->string('landed_at');
            $table->string('submitted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('typeform_responses');
    }
};
