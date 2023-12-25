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
        Schema::create('report_malfuncations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('technical_id')->nullable()->constrained('technicals');
            $table->foreignId('mechanic_id')->nullable()->constrained('mechanics');
            $table->foreignId('malfunction_id')->constrained('malfunctions');
            $table->text('description');
            $table->decimal('price');
            $table->string('status');
            $table->string('product');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_malfuncations');
    }
};
