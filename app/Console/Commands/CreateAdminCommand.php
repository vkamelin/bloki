<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {--name=} {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new administrator with full permissions';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Creating a new administrator...');

        // Get options or ask for input
        $name = $this->option('name') ?: $this->ask('Enter administrator name');
        $email = $this->option('email') ?: $this->ask('Enter administrator email');
        $password = $this->option('password') ?: $this->secret('Enter administrator password');

        // Validate input
        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ], [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        // Find admin role
        $adminRole = Role::where('slug', 'admin')->first();
        
        if (!$adminRole) {
            $this->error('Admin role not found. Please run the database seeders.');
            return 1;
        }

        // Create admin
        $admin = new Admin();
        $admin->name = $name;
        $admin->email = $email;
        $admin->password = Hash::make($password);
        $admin->is_active = true;
        $admin->role_id = $adminRole->id;
        $admin->save();

        // Assign role (many-to-many relationship)
        $admin->roles()->attach($adminRole->id);

        $this->info('Administrator created successfully!');
        $this->info("Name: {$admin->name}");
        $this->info("Email: {$admin->email}");
        $this->info("Role: {$adminRole->name}");

        return 0;
    }
}