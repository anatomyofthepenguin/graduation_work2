<?php

require '../vendor/autoload.php';
require  '../config/orm_settings.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

Capsule::schema()->dropIfExists('categories');

Capsule::schema()->create('categories', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name');
    $table->mediumText('description');
    $table->timestamps();
});

Capsule::schema()->dropIfExists('products');

Capsule::schema()->create('products', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name');
    $table->mediumText('description');
    $table->float('price')->unsigned();
    $table->integer('category_id')->unsigned();
    $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    $table->timestamps();
});
