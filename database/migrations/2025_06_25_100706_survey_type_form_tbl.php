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
         Schema::create('survey_type_form_tbl', function (Blueprint $table) {
            $table->id(); 
            $table->integer('type_form_id');
            $table->string('type_form_type');
            $table->string('title');
            $table->string('setting');
            $table->string('workspace');
            $table->string('self');
            $table->string('theme');
            $table->string('_links');
            $table->string('fields');
            $table->string('thankyou_screen');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('last_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_type_form_tbl');
    }
};
