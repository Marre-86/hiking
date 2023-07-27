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
            $table->integer('created_by_id')->nullable();
            $table->foreign('created_by_id')
                ->references('id')
                ->on('users');
            $table->integer('sport_id');
            $table->foreign('sport_id')
                ->references('id')
                ->on('sports');
            $table->integer('sport_type_id')->nullable();
            $table->foreign('sport_type_id')
                ->references('id')
                ->on('sport_types');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('track_file')->nullable();
            $table->double('distance')->nullable();
            $table->double('avgSpeed')->nullable();
            $table->string('avgPace')->nullable();
            $table->double('minAltitude')->nullable();
            $table->double('maxAltitude')->nullable();
            $table->double('cumulativeElevationGain')->nullable();
            $table->double('cumulativeElevationLoss')->nullable();
            $table->timestamp('startedAt')->nullable();
            $table->string('duration')->nullable();
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
