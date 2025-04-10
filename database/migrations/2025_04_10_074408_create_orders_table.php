<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('people')->cascadeOnDelete();
            $table->timestamp('order_time')->useCurrent();
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->string('payment_method', 50)->default('cash');
            $table->enum('status', ['paid', 'not_paid', 'cancelled'])->default('not_paid');
            $table->string('packages')->nullable(); // Store packages as a string, not JSON
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
