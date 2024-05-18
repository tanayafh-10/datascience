<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('heart', function (Blueprint $table) {
            $table->id();
            $table->integer('age');
            $table->integer('gender');
            $table->integer('impulse');
            $table->integer('pressurehight');
            $table->integer('pressurelow');
            $table->integer('glucose');
            $table->float('kcm');
            $table->float('troponin');
            $table->string('class');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heart');
    }
};
