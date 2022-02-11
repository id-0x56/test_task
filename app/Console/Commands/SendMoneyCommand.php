<?php

namespace App\Console\Commands;

use App\Jobs\UserAccountJob;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SendMoneyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'money:send {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send money to users';

    /**
     * @var User
     */
    protected User $users;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->users = new User();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $usersWithMoney = $this->users
            ->whereHas('moneys', function($query) {
                $query->where('count', '>', 0);
            });

        $offset = 0;
        $maxRecordCount = $this->argument('count');
        $totalRecordCount = $usersWithMoney->count();

        while ($offset <= $totalRecordCount)
        {
            $idJob = Str::random(5);

            $package = $usersWithMoney->skip($offset)->take($maxRecordCount)->get();
            $package->each(function ($user) use (&$idJob) {
                UserAccountJob::dispatch($user)->onQueue($idJob);
            });

            $offset += $maxRecordCount;
        }

        return 0;
    }
}
