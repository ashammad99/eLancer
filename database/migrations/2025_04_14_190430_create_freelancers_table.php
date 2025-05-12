<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreelancersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('freelancers', function (Blueprint $table) {
                $table->foreignId('user_id')
                    ->primary()
                    ->constrained('users')
                    ->cascadeOnDelete();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('title')->nullable();
                $table->string('country');
                $table->enum('gender', ['male', 'female'])->nullable();
                $table->date('birthday')->nullable();
                $table->string('profile_photo_path')->nullable();
                $table->text('description')->nullable();
                $table->unsignedFloat('hourly_rate')->nullable();
                $table->boolean('verified')->default(0);

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
        Schema::dropIfExists('freelancers');
    }
}
