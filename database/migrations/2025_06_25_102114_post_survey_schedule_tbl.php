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
        Schema::create('survey_schedule_tbl', function (Blueprint $table) {
            $table->id('survey_schedule_id'); 
            $table->integer('survey_id');
            $table->string('product_id');
            $table->string('product_type');
            $table->string('schedule_date');
            $table->string('status');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('last_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_schedule_tbl');
    }
};
