<?php


namespace App\Jobs;

use Exception;
use App\UserAction;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Очередь по созданию действий пользователей в фоне
 * Class CreateUserActionJob
 * @package App\Jobs
 */
class CreateUserActionJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        UserAction::create($this->data);
    }
}
