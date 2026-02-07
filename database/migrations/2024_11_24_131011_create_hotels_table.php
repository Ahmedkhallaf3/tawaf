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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('possition_en');
            $table->string('possition_ar');
            $table->integer('rate');
            $table->text('image');
            $table->string('overview_en');
            $table->string('overview_ar');
           

            $table->double('x_access');
            $table->double('y_access');

            $table->integer('price');
            // $table->string('availableroom_type_en');
            // $table->string('availableroom_type_ar');
            // $table->text('availableroom_image');
            // $table->text('availableroom_price');
           // $table->foreignId('amenity_id')->constrained('amenities')->onDelete('cascade');
            $table->text('privacy_en');
            $table->text('privacy_ar');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
