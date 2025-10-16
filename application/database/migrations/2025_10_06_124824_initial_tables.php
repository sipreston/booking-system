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
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->nullable();
            $table->string('first_name', 128);
            $table->string('last_name', 128);
            $table->string('email', 128)->unique();
            $table->string('phone', 20);
            $table->string('address_line_1', 128)->nullable();
            $table->string('address_line_2', 128)->nullable();
            $table->string('city', 128)->nullable();
            $table->string('county', 128)->nullable();
            $table->string('state', 128)->nullable();
            $table->string('post_code', 128)->nullable();
            $table->foreignId('country_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null')->onUpdate('set null');
        });

        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->foreignId('owner_id')->nullable();
            $table->string('address_line_1', 64)->nullable();
            $table->string('address_line_2', 64)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('county', 64)->nullable();
            $table->string('post_code', 12)->nullable();
            $table->string('state', 64)->nullable();
            $table->foreignId('country_id', 64)->nullable();
            $table->string('latitude', 64)->nullable();
            $table->string('longitude', 64)->nullable();
            $table->string('what_three_words_location', 128)->nullable();
            $table->json('images')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('is_active')->default(false);
            $table->integer('standard_check_in_time')->nullable();
            $table->integer('standard_check_out_time')->nullable();

            $table->foreign('owner_id')->references('id')->on('owners')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->nullable();
            $table->string('first_name', 64);
            $table->string('last_name', 64);
            $table->string('other_names', 128)->nullable();
            $table->string('email', 128)->unique();
            $table->string('telephone', 20);
            $table->string('mobile_phone', 20)->nullable();
            $table->string('address_line_1', 64)->nullable();
            $table->string('address_line_2', 64)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('county', 64)->nullable();
            $table->string('state', 64)->nullable();
            $table->string('post_code', 12)->nullable();
            $table->foreignId('country_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('unit_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type', 128);
            $table->string('code', 16)->unique();
            $table->longText('description')->nullable();
        });

        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('property_id');
            $table->string('identifier', 128);
            $table->foreignId('unit_type_id')->nullable();

            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('unit_type_id')->references('id')->on('unit_types')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type', 128);
            $table->string('code', 16)->unique();
            $table->longText('description')->nullable();
        });

        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('unit_id');
            $table->foreignId('room_type_id')->nullable();
            $table->string('identifier', 128);

            $table->foreign('unit_id')->references('id')->on('units')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('room_type_id')->references('id')->on('room_types')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('extras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 128);
            $table->longText('description')->nullable();
        });

        Schema::create('property_extra', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('property_id');
            $table->foreignId('extra_id');
            $table->integer('cost_in_pence');
            $table->boolean('is_active')->default(false);
            $table->string('details', 512)->nullable();
            $table->integer('quantity_available')->default(1);

            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('extra_id')->references('id')->on('extras')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('property_availability', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('property_id');
            $table->foreignId('unit_id');
            $table->date('date');
            $table->string('status');
            $table->integer('cost_in_pence')->nullable()->comment('The price for the day');;

            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name', 128);
            $table->longText('description')->nullable();
        });

        Schema::create('property_amenities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('property_id');
            $table->foreignId('amenity_id');
            $table->integer('cost_in_pence');
            $table->boolean('is_active')->default(false);
            $table->string('details', 512)->nullable();

            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('amenity_id')->references('id')->on('amenities')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('property_id')->nullable();
            $table->foreignId('unit_id')->nullable();
            $table->foreignId('room_id')->nullable();
            $table->date('date_from');
            $table->date('date_to');
            $table->integer('cost_in_pence');
            $table->integer('vat_rate')->nullable();
            $table->string('contact_email', 128)->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->integer('check_in_time');
            $table->integer('check_out_time');

            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('unit_id')->references('id')->on('units')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('room_id')->references('id')->on('rooms')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('booking_guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable();
            $table->string('first_name', 64);
            $table->string('last_name', 64);
            $table->string('contact_phone', 20)->nullable();
            $table->integer('age');

            $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('booking_revisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable();
            $table->dateTime('created_at');
            $table->json('flattened_data');

            $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('cascade')->onDelete('cascade');;
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('booking_id')->nullable();
            $table->date('payment_due_date');
            $table->integer('cost_in_pence');
            $table->double('vat_rate');
            $table->json('lines');

            $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->date('created_at');
            $table->integer('amount_in_pence');
            $table->foreignId('invoice_id')->nullable();
            $table->json('notes')->nullable();

            $table->foreign('invoice_id')->references('id')->on('invoices')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->date('created_at');
            $table->integer('amount_in_pence');
            $table->foreignId('invoice_id')->nullable();
            $table->json('notes')->nullable();

            $table->foreign('invoice_id')->references('id')->on('invoices')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
