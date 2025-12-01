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
        Schema::table('products', function (Blueprint $table) {
            $table->string('name');
            $table->string('description');
            $table->string('image')->nullable();
            $table->decimal('price',8,2);
            $table->foreignId('category_id')->constrained();
            $table->foreignId('country_id')->constrained();
            $table->unsignedInteger('count');
        });
    }
};
