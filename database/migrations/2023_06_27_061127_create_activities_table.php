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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('track_file')->nullable();
            $table->double('distance')->nullable();
            $table->double('avgSpeed')->nullable();
            $table->double('avgPace')->nullable();
            $table->double('minAltitude')->nullable();
            $table->double('maxAltitude')->nullable();
            $table->double('cumulativeElevationGain')->nullable();
            $table->double('cumulativeElevationLoss')->nullable();
            $table->timestamp('startedAt')->nullable();
            $table->timestamp('finishedAt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
