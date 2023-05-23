<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id',            )->length(10);
            $table->unsignedBigInteger('user_id');
            $table->string('name',              255);
            $table->string('surname',           255);
            $table->string('email',             255)->unique();
            $table->string('phone',             255)->nullable();
            $table->string('url',               255);
            $table->string('description',       255);
            $table->integer('ordering'             )->length(10)->unsigned()->nullable();
            $table->enum('status', array('hidden', 'published', 'pending'));
            $table->boolean('is_company')->default(false);
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
