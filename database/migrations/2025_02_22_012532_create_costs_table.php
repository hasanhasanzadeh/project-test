<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->string('amount');
            $table->string('description')->nullable();
            $table->enum('status',['pending','cancel','fail','accept','done'])->default('pending');
            $table->string('note')->nullable();
            $table->string('shaba',24);

            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('cost_file_id')->nullable();

            $table->foreign('user_id','users_costs_user_id_fk')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('category_id','categories_costs_category_id_fk')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('cost_file_id','files_costs_file_id_fk')
                ->references('id')
                ->on('files')
                ->nullOnDelete()
                ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('costs', function (Blueprint $table) {
            $table->dropForeign('users_costs_user_id_fk');
            $table->dropForeign('categories_costs_category_id_fk');
            $table->dropForeign('files_costs_file_id_fk');

            $table->dropIfExists();
        });
    }
};
