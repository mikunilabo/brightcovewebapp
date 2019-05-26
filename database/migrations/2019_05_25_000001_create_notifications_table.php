<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateNotificationsTable extends Migration
{
    /**
     * @var string
     */
    private $table = 'notifications';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('name');
                $table->string('notifiable_id', 36);
                $table->string('notifiable_type');
                $table->string('resource_id', 36)->nullable();
                $table->string('resource_type')->nullable();
                $table->string('subject');
                $table->text('content');
                $table->timestamp('read_at')->nullable();
                $table->timestamps();

                $table->index([
                    'notifiable_id',
                    'notifiable_type',
                ]);
            });
        } catch (\Exception $e) {
            report($e);
            $this->down();
            dd($e->getMessage());
        }
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
