<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->char('invoiceId');
            $table->string('product_name');
            $table->date('date');
            $table->string('sales_person');
            $table->string('customer_name');
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('employee_id')->constrained();
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
