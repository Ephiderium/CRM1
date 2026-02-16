<?php

namespace App\Console\Commands;

use App\Repository\Eloquent\Interfaces\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class MakeAdmin extends Command
{
    public function __construct(
        protected UserService $service,
        protected UserRepositoryInterface $users
    )
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-admin
                            {email : Email Administrator}
                            {password : Password Administrator}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создаёт пользователя-администратора, ввод почты и пароля';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            'name' => 'admin',
            'email' => $this->argument('email'),
            'password' => Hash::make($this->argument('password')),
            'is_active' => true,
        ];
        if (!$this->users->findByEmail($data['email'])) {
            $this->service->createAdmin($data);
            $this->info("Админ" . $data['email'] . "создан!");
            return self::SUCCESS;
        } else {
            $this->info('Админ уже создан');
            return self::SUCCESS;
        }
    }
}
