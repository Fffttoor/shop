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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->string('email');
            $table->string('phone');

            $table->enum('delivery', ['postal_service','self_delivery']);
            $table->enum('payment', ['online','postpaid']);

            $table->decimal('total_price', 10);

            $table->enum('status', ['new','in_progress','finished'])->default('new');

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->decimal('price', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id','product_id']);
        });
        Schema::dropIfExists('orders');
    }
};
