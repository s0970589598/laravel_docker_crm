<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClients extends Migration
{
    public function up() {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('phone');
            $table->string('email', 255);
            $table->text('section')->nullable();
            $table->text('budget')->nullable();
            $table->text('location');
            $table->text('zip')->nullable();
            $table->text('city')->nullable();
            $table->text('country')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->unsignedInteger('admin_id')->nullable();
            $table->date('birthday')->nullable();
            $table->integer('cumulative_spend_amt')->nullable()->default(0);
            $table->dateTime('last_shopping_time')->nullable();
            $table->string('level')->nullable();
            $table->integer('delivered_amt')->nullable()->default(0);
            $table->integer('refund_amt')->nullable()->default(0);
            $table->integer('used_amt')->nullable()->default(0);
            $table->integer('existing_amt')->nullable()->default(0);
            $table->string('membership')->nullable();
            $table->string('offer_info', 1)->nullable();
            $table->dateTime('period_time')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
