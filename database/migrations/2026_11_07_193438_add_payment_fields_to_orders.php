<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_method')->default('cash')->after('total'); // mtn, moov, cash
            $table->string('payment_status')->default('en_attente')->after('payment_method'); // paye, en_attente
            $table->string('delivery_address')->nullable()->after('payment_status');
            $table->string('phone_momo')->nullable()->after('delivery_address');
        });
    }
    public function down(): void {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_method','payment_status','delivery_address','phone_momo']);
        });
    }
};