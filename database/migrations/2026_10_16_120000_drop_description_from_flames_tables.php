<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tables from newly dynamic calculators where description is unused / null.
     */
    protected array $tables = [
        'flames_calculator_contents',
        'flames_report_contents',
        'moon_phase_report_contents',
        'mangal_dosha_report_contents',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'description')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('description');
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            if (Schema::hasTable($tableName) && !Schema::hasColumn($tableName, 'description')) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->longText('description')->nullable()->after('heading');
                });
            }
        }
    }
};
