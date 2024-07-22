<?php

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 3)->default('EGP');
            $table->enum('status', array_map(fn($status) => $status->value, PaymentStatusEnum::cases()))->default(PaymentStatusEnum::PENDING());
            $table->enum('payment_method', array_map(fn($method) => $method->value, PaymentMethodEnum::cases()))->default(PaymentMethodEnum::PAYMOB());
            $table->timestamp('transaction_date');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
