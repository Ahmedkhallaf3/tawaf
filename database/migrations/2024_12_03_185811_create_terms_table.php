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
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->text('title1_ar');
            $table->text('title1_en');
            $table->text('title2_ar')->nullable();
            $table->text('title2_en')->nullable();
            $table->text('title3_ar')->nullable();
            $table->text('title3_en')->nullable();
           

            $table->text('description1_ar');
            $table->text('description1_en');
            $table->text('description2_ar')->nullable();
            $table->text('description2_en')->nullable();
            $table->text('description3_ar')->nullable();
            $table->text('description3_en')->nullable();

            $table->string('phonenumber');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terms');
    }
};
