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
        Schema::table('committees', function (Blueprint $table) {
            $table->string('email')->nullable()->after('description');
            $table->integer('members')->default(0)->after('email');
            $table->longText('long_description')->nullable()->after('members');
            $table->json('responsibilities')->nullable()->after('long_description');
            $table->string('meetings')->nullable()->after('responsibilities');
            $table->json('achievements')->nullable()->after('meetings');
            $table->string('image')->nullable()->after('achievements');
            $table->decimal('impact_score', 3, 1)->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('committees', function (Blueprint $table) {
            $table->dropColumn([
                'email',
                'members',
                'long_description',
                'responsibilities',
                'meetings',
                'achievements',
                'image',
                'impact_score'
            ]);
        });
    }
};
