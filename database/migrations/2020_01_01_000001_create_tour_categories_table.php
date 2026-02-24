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
    Schema::create('tour_categories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained('tour_categories'); // Liên kết danh mục
        $table->string('name');
        $table->string('slug')->unique();
        $table->string('image')->nullable(); // Cột này đang thiếu dẫn đến lỗi
        $table->text('description')->nullable();
        $table->string('duration');
        $table->decimal('price', 12, 2);
        $table->decimal('child_price', 12, 2)->nullable();
        $table->integer('max_people'); // Cột này Controller yêu cầu nhưng DB có thể đang thiếu
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_categories');
    }
};
