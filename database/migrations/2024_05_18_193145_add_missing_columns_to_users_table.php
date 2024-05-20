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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number');
            $table->string('certificate');
            $table->string('image')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('phone_number');
      $table->dropColumn('certificate');
      $table->string('image')->default('images/avatars/default-avatar.png')->change();
      $table->dropUnique(['image']);
        });
    }
};
