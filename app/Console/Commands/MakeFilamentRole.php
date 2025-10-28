<?php

namespace App\Console\Commands;


use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class MakeFilamentRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:filament-user-role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Filament admin user with role selection';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->info("=== Create filament user with role ===");

        $name = $this->ask('Name');
        $email = $this->ask('Email');
        $password = $this->secret('Password');

        $role = $this->choice(
            'Select role',
            ['admin', 'user'],
            0 // default admin
        );

        $validator = Validator::make(compact('name', 'email', 'password'), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            $this->error('Validation errors:');
            foreach ($validator->errors()->all() as $error) {
                $this->line("- $error");
            }
            return Command::FAILURE;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'role' => $role
        ]);

        $this->info("User {$user->name} created successfully with role {$user->role}");

        return Command::SUCCESS;
    }
}
