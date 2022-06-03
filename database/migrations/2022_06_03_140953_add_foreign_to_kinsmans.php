<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToKinsmans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kinsmans', function (Blueprint $table) {
            $table->foreignId('life_id')
                ->nullable()
                ->constrained('kinsmans')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kinsmans', function (Blueprint $table) {
            $table->dropForeign('life_id');
            $table->dropColumn('life_id');
        });
    }
}
