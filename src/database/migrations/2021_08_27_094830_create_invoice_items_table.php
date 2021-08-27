<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 191);
            $table->text('detail');
            $table->boolean('status');
            $table->integer('invoice_id')->unsigned();
            $table->float('item_cost');
            $table->integer('item_qty');
            $table->float('item_total');
            $table->timestamps();
        });

        Schema::table('invoice_items', function($table) {
            $table->foreign('invoice_id')->references('id')->on('invoices');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}
