<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use LaravelEnso\Localisation\app\Models\Language;

class CreateLanguagesTable extends Migration
{
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->unique();
            $table->string('flag')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        $languages = [
           ['name' => 'br', 'display_name' => 'Brazilian Portuguese', 'flag' => 'flag-icon flag-icon-br', 'is_active' => true],
        ];

        \DB::transaction(function () use ($languages) {
            foreach ($languages as $language) {
                Language::create($language);
            }
        });
    }

    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
