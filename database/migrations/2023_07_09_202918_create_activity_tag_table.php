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
        Schema::create('activity_tag', function (Blueprint $table) {
            $table->primary(['tag_id','activity_id']);
            $table->integer('activity_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->foreign('activity_id')->references('id')->on('activities');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_activity');
    }
};
