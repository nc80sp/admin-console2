<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->integer('follow_user_id')->index();
            $table->timestamps();

            $table->unique(['user_id', 'follow_user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
