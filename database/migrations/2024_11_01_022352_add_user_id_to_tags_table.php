<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToTagsTable extends Migration
{
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            // Tambahkan kolom user_id yang nullable terlebih dahulu untuk mencegah error
            $table->foreignId('user_id')
                ->nullable()  // Izinkan nullable untuk sementara waktu
                ->constrained('users')
                ->onDelete('cascade')
                ->after('id');
        });
    }

    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
