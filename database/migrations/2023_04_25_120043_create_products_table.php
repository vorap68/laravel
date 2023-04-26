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
         $table->bigInteger('category_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('code');
            $table->text('description')->nullable();
            $table->text('image')->nullable();
           $table->tinyinteger('new')->default(0);
             $table->tinyinteger('hit')->default(0);
              $table->tinyinteger('recommend')->default(0);
                $table->softDeletes();
            $table->timestamps();
            
            //$table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
             
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
