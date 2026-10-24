<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->decimal('monto', 8, 2)->default(150.00)->after('motivo');
            $table->string('estado_pago')->default('pendiente')->after('monto');
            $table->string('metodo_pago')->nullable()->after('estado_pago');
        });
    }

    public function down(): void
    {
        Schema::table('citas', function (Blueprint $table) {
            $table->dropColumn(['monto', 'estado_pago', 'metodo_pago']);
        });
    }
};