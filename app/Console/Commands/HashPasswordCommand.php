<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class HashPasswordCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password:hash {password? : The password to hash}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hash a password using Laravel\'s Hash facade';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $password = $this->argument('password') ?: $this->secret('Enter password to hash');
        
        if (empty($password)) {
            $this->error('Password cannot be empty');
            return 1;
        }
        
        $hashedPassword = Hash::make($password);
        
        $this->info('Password hashed successfully!');
        $this->line('Plain password: ' . $password);
        $this->line('Hashed password: ' . $hashedPassword);
        
        return 0;
    }
}