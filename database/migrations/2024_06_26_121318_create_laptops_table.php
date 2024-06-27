<?php

use App\Models\Manufacturer;
use App\Models\Processor;
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
        Schema::create('laptops', function (Blueprint $table) {
            $table->id();
            $table->string('sr_number');
            $table->string('uid')->nullable();
            $table->string('asset_type')
                ->nullable()
                ->default('LPT');
            $table->foreignIdFor(Manufacturer::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Processor::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('model');
            $table->string('ram');
            $table->string('memory_type');
            $table->string('memory_size');
            $table->string('operating_system');
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptops');
    }
};
