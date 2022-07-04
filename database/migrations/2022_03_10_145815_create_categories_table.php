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
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('category_id')->autoIncrement();
            $table->string('name');
            $table->string('description');
            $table->integer('parent_id')->default(0);
            $table->integer('show_menu')->default(0);
            $table->string('icon')->default('icon.png');
            $table->string('added_by')->default('admin@sms.com');
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('categories');
    }
};
