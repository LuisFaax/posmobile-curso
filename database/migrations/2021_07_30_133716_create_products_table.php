<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 25)->nullable();
            $table->string('name', 50);
            $table->string('description', 255)->nullable();
            $table->decimal('cost', 10, 2)->default(0);
            $table->decimal('price1', 10, 2)->default(0);
            $table->decimal('price2', 10, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->integer('minstock')->default(0);
            $table->foreignId('category_id')->constrained();
            $table->foreignId('measure_id')->constrained();

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
        Schema::dropIfExists('products');
    }
}
