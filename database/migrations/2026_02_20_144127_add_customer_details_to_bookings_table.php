<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('bookings', function (Blueprint $table) {
        // Thêm cột ngày khởi hành
        $table->date('departure_date')->nullable()->after('quantity');
        
        // Thêm các cột thông tin khách hàng (để tránh lỗi hiện Administrator)
        $table->string('customer_name')->nullable()->after('user_id');
        $table->string('customer_email')->nullable()->after('customer_name');
        $table->string('customer_phone')->nullable()->after('customer_email');
    });
}

public function down()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropColumn(['departure_date', 'customer_name', 'customer_email', 'customer_phone']);
    });
}
};
