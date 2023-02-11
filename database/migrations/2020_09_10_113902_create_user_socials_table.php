<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('user_socials', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->string('provider');
            $table->string('provider_id');
            $table->char('hash', 26);
            $table->timestamps();

            $table->unique(['provider', 'provider_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('user_socials', static function($table)
        {
            $table->dropForeign('user_socials_user_id_foreign'); // Drop foreign key 'user_id' from 'posts' table
        });
        Schema::dropIfExists('user_socials');
    }
}
