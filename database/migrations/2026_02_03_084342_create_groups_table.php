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
        Schema::create('groups', function (Blueprint $table) {
    $table->id();
    $table->foreignId('trip_id')->constrained('trips')->cascadeOnDelete();
    $table->enum('type', ['doan', 'ghep_cap', 'ghep_nhom']);
    $table->integer('max_people');
    $table->integer('current_people')->default(0);
    $table->enum('status', ['open', 'full', 'closed'])->default('open');
    $table->string('note')->nullable();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
