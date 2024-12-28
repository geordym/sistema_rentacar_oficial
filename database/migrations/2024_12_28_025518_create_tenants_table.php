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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id(); // ID of the tenant (Primary Key)
            $table->string('name'); // Tenant's full name
            $table->string('nationality')->nullable(); // Tenant's nationality (optional)
            $table->string('document_type'); // Tenant's document type (e.g., passport, ID)
            $table->string('document_number'); // Tenant's document number (e.g., passport number or ID number)
            $table->string('address'); // Tenant's address (street address)
            $table->string('city')->nullable(); // Tenant's city or municipality (optional)
            $table->string('municipality')->nullable(); // Lessor's city or municipality (optional)
            $table->string('license_number')->nullable(); // Tenant's license number (if applicable, e.g., driver's license)
            $table->binary('document_image')->nullable(); // Tenant's document image (optional, stored as binary)
            $table->string('payment_concept')->nullable(); // Payment concept (optional, e.g., rent, services)
            $table->decimal('payment_amount', 10, 2)->nullable(); // Payment amount (optional, e.g., rent amount)
            $table->binary('signature_image')->nullable(); // Tenant's signature image (optional)
            $table->dateTime('signature_date')->nullable(); // Date when the tenant signed the contract (optional)
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
        Schema::dropIfExists('tenants');
    }
};
