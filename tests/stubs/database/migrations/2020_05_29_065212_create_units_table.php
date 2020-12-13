<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('type');
            $table->boolean('active')->default(0);

            $table->timestamps();
        });
    }
}
