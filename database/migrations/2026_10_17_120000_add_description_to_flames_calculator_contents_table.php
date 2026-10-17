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
        if (Schema::hasTable('flames_calculator_contents')) {
            Schema::table('flames_calculator_contents', function (Blueprint $table) {
                if (!Schema::hasColumn('flames_calculator_contents', 'description')) {
                    $table->longText('description')->nullable()->after('heading');
                }
            });
        }

        if (Schema::hasTable('flames_report_contents')) {
            Schema::table('flames_report_contents', function (Blueprint $table) {
                if (!Schema::hasColumn('flames_report_contents', 'description')) {
                    $table->longText('description')->nullable()->after('heading');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('flames_calculator_contents')) {
            Schema::table('flames_calculator_contents', function (Blueprint $table) {
                if (Schema::hasColumn('flames_calculator_contents', 'description')) {
                    $table->dropColumn('description');
                }
            });
        }

        if (Schema::hasTable('flames_report_contents')) {
            Schema::table('flames_report_contents', function (Blueprint $table) {
                if (Schema::hasColumn('flames_report_contents', 'description')) {
                    $table->dropColumn('description');
                }
            });
        }
    }
};
