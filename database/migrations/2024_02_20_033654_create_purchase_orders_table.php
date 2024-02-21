<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // Número de orden único
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // FK a la tabla de usuarios
            $table->decimal('total', 10, 2); // Total de la orden
            $table->enum('status', ['pending', 'shipped', 'completed'])->default('pending'); // Estado de la orden
            $table->timestamp('approved_at')->nullable(); // Fecha de aprobación
            $table->timestamp('completed_at')->nullable(); // Fecha de completado
            $table->timestamp('shipped_at')->nullable(); // Fecha de envío
            $table->timestamp('delivered_at')->nullable(); // Fecha de entrega
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
