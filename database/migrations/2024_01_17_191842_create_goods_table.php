<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->string('good_import_id');
            $table->string('name');
            $table->string('url');
            $table->integer('price');
            $table->integer('old_price');
            $table->string('currencyId');
            $table->unsignedBigInteger('category_id');
            $table->string('picture');
            $table->string('vendor');
            $table->boolean('available');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('goods');
    }
};
