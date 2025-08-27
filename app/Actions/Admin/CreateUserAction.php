<?php

namespace App\Actions\Admin;

use App\Models\User;
use App\Mail\NewUserWelcome;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CreateUserAction
{
    public function execute(array $userData): array
    {
        $autoPassword = $this->generateSecurePassword();
        $slug = $this->generateUniqueSlug($userData['name']);

        $user = User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'password' => Hash::make($autoPassword),
            'slug' => $slug,
            'user_type' => 'user',
            'status' => 'active',
        ]);

        // Send welcome email
        try {
            Mail::to($user->email)->send(new NewUserWelcome($user, $autoPassword));
        } catch (\Exception $e) {
            // Log email error but don't fail the user creation
            Log::warning('Failed to send welcome email to user: ' . $user->email, [
                'error' => $e->getMessage()
            ]);
        }

        return [
            'user' => $user,
            'password' => $autoPassword
        ];
    }

    private function generateSecurePassword(): string
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle($chars), 0, 8);
    }

    private function generateUniqueSlug(string $name): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while (User::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
