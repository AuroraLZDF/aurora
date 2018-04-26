<?php

namespace App\Console\Commands;

use App\Models\Bbs\Traits\LastActivedAtHelper;
use App\Models\Bbs\User;
use Illuminate\Console\Command;

class SyncUserActivedAt extends Command
{
    use LastActivedAtHelper;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larabbs:sync-user-actived-at';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '将用户最后登录时间从 Redis 同步到数据库中';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param User $user
     * @return mixed
     */
    public function handle(User $user)
    {
        $this->syncUserActivedAt($user);
        $this->info("同步成功！");
    }
}
