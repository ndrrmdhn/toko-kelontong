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
        Schema::table('banners', function (Blueprint $table) {
            $table->string('button_text')->nullable()->after('description');
            $table->string('button_link')->nullable()->after('button_text');
            $table->integer('sort_order')->default(0)->after('is_active');
            $table->dropColumn('link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table) {
            $table->string('link')->nullable();
            $table->dropColumn(['button_text', 'button_link', 'sort_order']);
        });
    }
};
