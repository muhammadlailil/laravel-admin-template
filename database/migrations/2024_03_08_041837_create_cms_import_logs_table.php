<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cms_import_logs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('filename');
            $table->foreignId('user_id')->nullable()->constrained('cms_admins')->nullOnDelete();
            $table->string('upload_by');
            $table->string('module', 50)->index();
            $table->integer('total_data');
            $table->double('progress')->default(0);
            $table->integer('total_insert')->default(0);
            $table->integer('total_skip')->default(0);
            $table->integer('total_update')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_import_logs');
    }
};
