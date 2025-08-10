<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // اطمینان از وجود نقش admin
        $role = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        // بررسی اینکه آیا کاربر ادمین قبلاً ساخته شده
        $adminEmail = 'admin@admin.com';

        if (! User::where('email', $adminEmail)->exists()) {
            $user = User::create([
                'name' => 'Admin User',
                'email' => $adminEmail,
                'password' => Hash::make('password'), // رمز: password
            ]);

            // اختصاص نقش
            $user->assignRole($role);

            $this->command->info('✅ کاربر ادمین با موفقیت ایجاد شد:');
            $this->command->info('ایمیل: admin@admin.com');
            $this->command->info('رمز: password');
        } else {
            $this->command->warn('⚠️ کاربر ادمین قبلاً وجود داشت.');
        }
    }
}
