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
        Schema::table('rental_agreements', function (Blueprint $table) {
            $table->integer('lessor_id')->default(-1);
            $table->integer('tenant_id')->default(-1);
            $table->integer('rental_agreement_duration_days')->default(-1);
            
            $table->text('lease_clause_third_tenant_payment_concept')->default('-1');
            $table->text('lease_clause_third_tenant_payment_amount')->default('-1');
            
            $table->text('lease_clause_fifth_transport_concept')->default('-1');
            $table->text('lease_clause_fifth_transport_destination')->default('-1');
            $table->text('lease_signature_city')->default('-1');
            $table->text('lease_signature_date')->default('-1');
            $table->text('contract_number')->default('-1');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rental_agreements', function (Blueprint $table) {
            $table->dropColumn([
                'lease_clause_third_tenant_payment_concept',
                'lease_clause_third_tenant_payment_amount',
                'lease_clause_fifth_transport_concept',
                'lease_clause_fifth_transport_destination',
                'lease_signature_city',
                'lease_signature_date',
                'contract_number'
            ]);
        });
    }
    
};
