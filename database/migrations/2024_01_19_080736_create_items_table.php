<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('order_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('package_id')->nullable();
            $table->string('description')->nullable();
            $table->float('weight')->nullable();
            $table->float('height')->nullable();
            $table->float('width')->nullable();
            $table->float('length')->nullable();
            $table->float('volume')->nullable();
            $table->string('receiver')->nullable();
            $table->integer('receiver_phone')->nullable();
            $table->string('delivery_price')->nullable();
            $table->text('receiver_address')->nullable();
            $table->float('item_value')->nullable();
            $table->string('customer_comment')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->foreign('driver_id')->references('id')->on('users');
            $table->string('driver_comment')->nullable();
            $table->foreignId('sector_id')->nullable()->constrained();
            $table->boolean('delivered')->default(false)->nullable();
            $table->boolean('status')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
