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
        Schema::create('booknows', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('phonenumber');
            $table->text('specialrequest');
            $table->string('check_in_ar');
            $table->string('check_in_en');
            $table->string('check_out_ar');
            $table->string('check_out_en');
            $table->integer('totalprice')->nullable();
            $table->integer('numberofroom');
            $table->integer('numberofadult')->nullable();
            $table->integer('numberofchild')->nullable();
            $table->json('age_child')->nullable();
            $table->foreignId('room_id')->constrained('avilablerooms')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booknows');
    }
};
