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
          Schema::create('survey_product_suggestion_tbl', function (Blueprint $table) {
            $table->id('product_suggestion_id'); 
            $table->integer('id');
            $table->integer('product_type');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('last_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('survey_product_suggestion_tbl');
    }
};
