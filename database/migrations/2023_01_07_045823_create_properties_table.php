<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->unsignedInteger('price');
            $table->unsignedInteger('sqm');
            $table->unsignedTinyInteger('bedrooms')->nullable();
            $table->unsignedTinyInteger('bathrooms')->nullable();
            $table->unsignedTinyInteger('garages')->default();
            $table->boolean('slider')
                ->default(value:false);
            $table->boolean('visible')
                ->default(value:true);
            $table->date('start_date')->default(value:'2022-01-01');
            $table->date('end_date')->default(value:'2023-01-01');
            $table->softDeletes();
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
        Schema::dropIfExists('properties');
    }
};
