<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 191);
            $table->text('detail');
            $table->integer('company_id')->unsigned();
            $table->boolean('status');
            $table->string('invoice_to', 191);
            $table->string('invoice_number')->unique();
            $table->date('invoice_date');
            $table->date('invoice_due_date');
            $table->float('invoice_total');
            $table->timestamps();
        });

        Schema::table('invoices', function($table) {
            $table->foreign('company_id')->references('id')->on('companies');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
