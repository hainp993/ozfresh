<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWareHouseBillItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ware_house_bill_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('quantity');
            $table->double('amount');
            $table->string('note');
            $table->date('date')->nullable();

            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger("bill_id");
            $table->foreign("product_id")->references("id")->on("products")->onDelete('cascade');
            $table->foreign("bill_id")->references("id")->on("ware_house_bills")->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ware_house_bill_items');
    }
}
