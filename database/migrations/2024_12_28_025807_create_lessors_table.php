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
        Schema::create('lessors', function (Blueprint $table) {
            $table->id(); 
            $table->string('name'); 
            $table->string('nationality')->nullable(); // Lessor's nationality (optional)
            $table->string('document_type'); // Lessor's document type (e.g., passport, ID)
            $table->string('document_number'); // Lessor's document number (e.g., passport number or ID number)
            $table->string('address'); // Lessor's address (street address)
            $table->string('city_municipality')->nullable(); // Lessor's city or municipality (optional)
            $table->string('license_number')->nullable(); // Lessor's license number (optional, e.g., driver's license)
            $table->binary('document_image')->nullable(); // Lessor's document image (optional)
            $table->string('payment_concept')->nullable(); // Payment concept (optional, e.g., rent, services)
            $table->binary('signature_image')->nullable(); // Lessor's signature image (optional)
            $table->dateTime('signature_date')->nullable(); // Date when the lessor signed the contract (optional)
            $table->timestamps(); // Laravel's created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_vehicle_lessor');
    }
};
