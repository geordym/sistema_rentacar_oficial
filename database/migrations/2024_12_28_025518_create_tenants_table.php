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
            $table->id();
            $table->string('name');
            $table->string('nationality');
            $table->string('document_type');
            $table->string('document_number');
            $table->string('residence_address');
           
            $table->string('city');
            $table->string('municipality');
            $table->string('license_number');
            $table->string('license_issued_state');

            
            $table->longText('drive_license_image');
            $table->longText('document_image');
            $table->longText('signature_image')->nullable();
       
            $table->timestamps();
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
