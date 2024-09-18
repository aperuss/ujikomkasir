<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('transaksis', function (Blueprint $table) {
        $table->unsignedBigInteger('member_id')->nullable()->after('id');
        $table->foreign('member_id')->references('id')->on('members')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('transaksis', function (Blueprint $table) {
        $table->dropForeign(['member_id']);
        $table->dropColumn('member_id');
    });
}

};