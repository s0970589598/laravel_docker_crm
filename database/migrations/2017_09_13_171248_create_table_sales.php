<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('quantity');
            $table->integer('price');
            $table->date('date_of_payment');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->boolean('is_active')->nullable()->default(1);
            $table->unsignedInteger('admin_id');

            $table->string('order_no');
            $table->string('order_status')->nullable();
            $table->string('pre_order')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('payment_order_no')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('discount_shop_amt')->nullable();
            $table->integer('sum_amt')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_type')->nullable();
            $table->string('utm_source')->nullable();
            $table->string('shipping_status')->nullable();
            $table->dateTime('pickup_time')->nullable();
            $table->string('client_level')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_sex')->nullable();
            $table->string('client_birthday')->nullable();
            $table->string('client_id')->nullable();

            $table->foreign('admin_id')->references('id')->on('admins');
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
        Schema::dropIfExists('sales');
    }
}
