<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('cost', 8, 2);
            $table->integer('quantity')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('transaction_type_id')->nullable();
            $table->unsignedBigInteger('transaction_status_id')->nullable();
            $table->text('transaction_status_details')->nullable()
                ->comment('When other status is met, details regarding the transaction will be stored here.');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');

            $table->foreign('transaction_type_id')
                ->references('id')
                ->on('transaction_types')
                ->onDelete('set null');

            $table->foreign('transaction_status_id')
                ->references('id')
                ->on('transaction_statuses')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
