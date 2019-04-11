<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateLoginHistoriesTable extends Migration
{
    /**
     * @var string
     */
    private $table = 'login_histories';

    /**
     * @return void
     */
    public function up()
    {
        try {
            Schema::create($this->table, function (Blueprint $table) {
                $table->increments('id');
                $table->uuid('user_id');
                $table->ipAddress('ip');
                $table->string('host', 64);
                $table->string('user_agent');
                $table->mediumInteger('remote_port');
                $table->mediumInteger('access_port');
                $table->timestamp('created_at'->nullable());

                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
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
