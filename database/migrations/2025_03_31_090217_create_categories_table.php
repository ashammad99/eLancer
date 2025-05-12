<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {

            //id unsigned bigint auto-increment primary-key
            //in laravel table must table has a primary key
            //$table->bigInteger('id')->unsigned()->autoIncrement()->primary();
            //$table->unsignedBigInteger('id')->autoIncrement()->primary();
            //$table->bigIncrements('id')->primary();
            $table->id();
            //varchar(255)
            //string('colName',size -  by default 255)
            $table->string('name')->unique();
            //this column for SEO usage
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('art_path')->nullable();

            /*
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('categories')
                ->nullOnDelete();//->onDelete('null');
            */
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('categories','id')
                ->nullOnDelete();
            //created_at timestamp null
            //updated_at timestamp null
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
