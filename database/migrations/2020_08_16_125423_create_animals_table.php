<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            // Model fields
            $table->id();
            $table->timestamps();
            $table->string("name", 100);
            $table->string("type", 100);
            $table->date("dob");
            $table->decimal("weight", 6, 2);
            $table->decimal("height", 6, 2);
            $table->integer("biteyness");

            // Foreign key
            $table->foreignId("owner_id");

            // Foreign key constraint
            $table->foreign("owner_id")->references("id")
                ->on("owners")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
