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
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            // Primary key and fields
            $table->id(); // ID as the primary key (auto-increment)
            $table->string('name'); // Product name
            $table->decimal('price', 8, 3); // Price (max 8 digits, 2 decimal places)
            $table->integer('quantity_available'); // Quantity Available
            $table->integer('in_stock'); // in stock
            $table->integer('out_stock'); // out stock

            // Foreign keys for user relationships
            $table->foreignId('created_user_id')
                  ->nullable() // Allow null values
                  ->constrained('users')  // References the 'id' column in the 'users' table
                  ->onDelete('set null');  // Set to null if user is deleted
            
            $table->foreignId('updated_user_id')
                  ->nullable() // Allow null values
                  ->constrained('users')  // References the 'id' column in the 'users' table
                  ->onDelete('set null');  // Set to null if user is deleted

            // Timestamps
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
