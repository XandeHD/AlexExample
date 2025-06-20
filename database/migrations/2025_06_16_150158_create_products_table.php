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
        Schema::create('products', function (Blueprint $table) {
            $table->id('prodid');
            $table->string('code');
            $table->string('category')->default('');
            $table->string('type')->default('');
            $table->string('description')->default('');
            $table->string('brand')->default('');
            $table->string('barcode')->default('');
            $table->string('color')->default('');
            $table->boolean('is_hazardous')->default(0);
            
            $table->string('batch')->default('');
            $table->dateTime('expiration_date')->default('1900-01-01 00:00:00');

            $table->string('material')->default('');
            $table->string('model')->default('');
            $table->string('serial_number')->default('');
            $table->decimal('width',8,3)->default(0);
            $table->decimal('length',8,3)->default(0);
            $table->decimal('volume',8,3)->default(0);
            $table->decimal('weight',8,3)->default(0);
            $table->decimal('density',8,4)->default(0);

            $table->decimal('storage_temp', 5, 2)->default(0)->comment('ºC');
            $table->decimal('ph', 4, 2)->default(0)->comment('(pH)');
            $table->decimal('concentration',8,3)->default(0);
            $table->string('concentration_unit', 10)->default('');

            
            

            $table->timestamps();
        });

          

        
        // 'expiration_date',  
        // 'batch',           
        // 'is_hazardous',     // Dangerous
        // 'storage_temp',     // Temperature of Storage
        // 'ph',               // pH (Acid)
        // 'concentration',    // Percentage
        // 'barcode',

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
