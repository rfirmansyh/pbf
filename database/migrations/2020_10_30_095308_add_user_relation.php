<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo')->nullable();
            $table->string('phone');
            $table->text('bio')->nullable();
            $table->string('provinsi', 50)->nullable();
            $table->string('kabupaten', 50)->nullable();
            $table->string('kecamatan', 50)->nullable();
            $table->string('kelurahan', 50)->nullable();
            $table->string('detail_address', 100)->nullable();
            $table->enum('status', ['0', '1']);
            $table->softDeletes();
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('role_id');
    
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropcolumn('photo');
            $table->dropcolumn('phone');
            $table->dropcolumn('bio');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('detail_address');
            $table->dropcolumn('status', ['0', '1']);
            $table->dropcolumn('deleted_at');
            $table->dropcolumn('role_id');
            $table->dropforeign('user_role_id_foreign');
        });
    }
}
