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
        Schema::create('concerts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('club_id')->nullable();
            $table->unsignedBigInteger('added_by_user_id')->nullable();
            $table->string('description')->nullable();
            $table->dateTime('event_start_date');
            $table->dateTime('event_end_date');
            $table->integer('income');
            $table->text('facebook_event_url')->nullable();
            $table->text('liveset_url')->nullable();
            $table->boolean('is_expired');
            $table->timestamps();

            $table->foreign('added_by_user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concerts');
    }
};
