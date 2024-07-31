<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_stages', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('stage_id');
            $table->integer('clear_count');
            $table->float('best_time');
            $table->timestamps();

            $table->index('stage_id', 'best_time');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_stages');
    }
};
