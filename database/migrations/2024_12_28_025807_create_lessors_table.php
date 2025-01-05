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
            $table->string('nationality'); // Lessor's nationality (optional)
            $table->string('document_type'); // Lessor's document type (e.g., passport, ID)
            $table->string('document_number'); // Lessor's document number (e.g., passport number or ID number)
            $table->string('residence_address'); // Lessor's address (street address)
            $table->string('fiscal_address'); // Lessor's address (street address)

            $table->string('city'); // Lessor's city or municipality (optional)

            $table->string('municipality'); // Lessor's city or municipality (optional)
            $table->string('license_number'); // Lessor's license number (optional, e.g., driver's license)
            $table->longText('document_image'); // Lessor's document image (optional)
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
