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
        Schema::create('article_resources', function (Blueprint $table) {
            $table->id();

            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->string('file');
            $table->string('description',100);
            $table->boolean('article_content_resource')->defaultFalse();
            
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
        Schema::dropIfExists('article_resources');
    }
};
