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
        Schema::create('broker_contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('agency_company_name');
            $table->string('agency_company_address');
            $table->string('company_phone');
            $table->string('company_mobile');
            $table->string('company_email');
            $table->string('zip_code');
            $table->string('po_box');
            $table->string('trade_licence');
            $table->date('trade_licence_validity');
            $table->string('rera');
            $table->date('rera_validity');
            $table->string('tax_reg');
            $table->date('trn_validity');
            $table->string('beneficiary_name');
            $table->string('account');
            $table->string('iban');
            $table->string('swift_code');
            $table->string('bank_name');
            $table->text('bank_address');
            $table->text('account_currency');
            $table->string('name_of_authorized_signatory_on_passport');
            $table->string('personal_email');
            $table->string('mobile');
            $table->string('address');
            $table->string('passport_number');
            $table->string('passport_validity');
            $table->string('nationality');
            $table->string('designation');
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
        Schema::dropIfExists('broker_contact_us');
    }
};
