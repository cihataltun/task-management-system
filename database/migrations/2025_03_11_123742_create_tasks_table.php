<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            // Görevi oluşturan kullanıcı (yaratıcı)
            $table->unsignedBigInteger('user_id');
            // Görevin atanacağı kullanıcı (atanan)
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Atanan kullanıcı silinirse, alanı null yap (ya da isterseniz cascade de kullanabilirsiniz)
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
