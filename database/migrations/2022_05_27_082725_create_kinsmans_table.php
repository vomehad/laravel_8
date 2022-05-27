<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKinsmansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('kins')) {
            Schema::create('kins', function (Blueprint $table) {
                $table->id();
                $table->tinyText('name');
                $table->text('slug')->unique();
                $table->tinyText('generation');
                $table->foreignId('created_by')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
                $table->timestamps();
                $table->boolean('active')->default(true);
                $table->softDeletes();
            });
        }
        if (!Schema::hasTable('kinsmans')) {
            Schema::create('kinsmans', function (Blueprint $table) {
                $table->id();
                $table->tinyText('name');
                $table->tinyText('middle_name');
                $table->tinyText('gender');
                $table->foreignId('father_id')->constrained('kinsmans')->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('mother_id')->constrained('kinsmans')->cascadeOnUpdate()->cascadeOnDelete();
                $table->foreignId('kin_id')->constrained('kins');
                $table->timestamps();
                $table->boolean('active')->default(true);
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kinsmans');
    }
}
