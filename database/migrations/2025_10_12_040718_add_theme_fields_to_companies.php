<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // Only add if they don't already exist
            if (!Schema::hasColumn('companies', 'code')) {
                $table->string('code')->nullable()->unique();
            }

            if (!Schema::hasColumn('companies', 'primary_color')) {
                $table->string('primary_color')->nullable();
            }

            if (!Schema::hasColumn('companies', 'accent_color')) {
                $table->string('accent_color')->nullable();
            }

            if (!Schema::hasColumn('companies', 'logo_url')) {
                $table->string('logo_url')->nullable(); // path or URL, e.g. /logos/technova.png
            }
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            if (Schema::hasColumn('companies', 'code')) {
                $table->dropColumn('code');
            }

            if (Schema::hasColumn('companies', 'primary_color')) {
                $table->dropColumn('primary_color');
            }

            if (Schema::hasColumn('companies', 'accent_color')) {
                $table->dropColumn('accent_color');
            }

            if (Schema::hasColumn('companies', 'logo_url')) {
                $table->dropColumn('logo_url');
            }
        });
    }
};
