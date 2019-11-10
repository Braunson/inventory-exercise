<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_category_id')->nullable();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->text('description')->nullable();
            $table->decimal('cost', 8, 2)->default(0)->nullable();
            $table->decimal('quantity', 8, 0)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_category_id')
                ->references('id')
                ->on('product_categories')
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
        Schema::dropIfExists('products');
    }
}
