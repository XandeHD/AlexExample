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
        Schema::create('sample_test_langs', function (Blueprint $table) {
            // $table
            $table->primary(['code','lang']);
            $table->string('code');
            $table->string('lang')->default('');
            $table->string('shortdescription')->default('');
            $table->string('description')->default('');
            $table->string('created_by')->default('');
            $table->string('updated_by')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sample_test_langs');
    }
};
