<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

// Test route to check admin login status
Route::get('/test-admin-login', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return response()->json([
            'logged_in' => true,
            'name' => $user->name,
            'email' => $user->email,
            'user_type' => $user->user_type,
            'message' => 'User is logged in successfully'
        ]);
    } else {
        return response()->json([
            'logged_in' => false,
            'message' => 'User is not logged in'
        ]);
    }
});

// Test route to check user slugs
Route::get('/test-users', function () {
    $users = User::select('id', 'name', 'slug')->get();

    $output = '<h1>Users and their slugs:</h1>';
    foreach ($users as $user) {
        $output .= '<p><strong>ID:</strong> ' . $user->id . ' | <strong>Name:</strong> ' . $user->name . ' | <strong>Slug:</strong> ' . $user->slug . '</p>';
        $output .= '<p><a href="/' . $user->slug . '">Test Link: /' . $user->slug . '</a></p><hr>';
    }

    return $output;
});

// Test route to debug specific slug
Route::get('/test-slug/{slug}', function ($slug) {
    $user = User::where('slug', $slug)->first();

    if ($user) {
        return '<h1>User Found!</h1><p><strong>Name:</strong> ' . $user->name . '</p><p><strong>Slug:</strong> ' . $user->slug . '</p><p><a href="/' . $slug . '">Go to Profile</a></p>';
    } else {
        return '<h1>User NOT Found</h1><p>No user with slug: ' . $slug . '</p>';
    }
});

// Test email configuration
Route::get('/test-email', function () {
    try {
        $testData = [
            'first_name' => 'Test',
            'last_name' => 'User',
            'personal_email' => 'test@example.com',
            'professional_email' => '',
            'current_organization' => 'Test Company',
            'position' => 'Developer',
            'technologies' => 'PHP, Laravel, JavaScript'
        ];

        // Test sending email
        Mail::send('emails.contact-inquiry', ['contactData' => $testData], function($message) use ($testData) {
            $message->to('admin@meetmytech.com')
                    ->from('admin@meetmytech.com', 'MeetMyTech Platform')
                    ->subject('Test Email - Configuration Check');
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Test email sent successfully!',
            'config' => [
                'mail_driver' => config('mail.default'),
                'mail_host' => config('mail.mailers.smtp.host'),
                'mail_port' => config('mail.mailers.smtp.port'),
                'mail_encryption' => config('mail.mailers.smtp.encryption'),
                'mail_username' => config('mail.mailers.smtp.username'),
                'mail_from' => config('mail.from.address'),
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to send email: ' . $e->getMessage(),
            'config' => [
                'mail_driver' => config('mail.default'),
                'mail_host' => config('mail.mailers.smtp.host'),
                'mail_port' => config('mail.mailers.smtp.port'),
                'mail_encryption' => config('mail.mailers.smtp.encryption'),
                'mail_username' => config('mail.mailers.smtp.username'),
                'mail_from' => config('mail.from.address'),
            ]
        ], 500);
    }
});

// Test email configuration with detailed debugging
Route::get('/test-email-debug', function () {
    try {
        // Check current mail configuration
        $config = [
            'driver' => config('mail.default'),
            'host' => config('mail.mailers.smtp.host'),
            'port' => config('mail.mailers.smtp.port'),
            'encryption' => config('mail.mailers.smtp.encryption'),
            'username' => config('mail.mailers.smtp.username'),
            'from_address' => config('mail.from.address'),
            'from_name' => config('mail.from.name'),
        ];

        // Try to create a transport to test connection
        $transport = new \Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport(
            config('mail.mailers.smtp.host'),
            config('mail.mailers.smtp.port'),
            config('mail.mailers.smtp.encryption') === 'tls'
        );

        $transport->setUsername(config('mail.mailers.smtp.username'));
        $transport->setPassword(config('mail.mailers.smtp.password'));

        // Test simple mail send
        Mail::raw('This is a test email from MeetMyTech', function($message) {
            $message->to('admin@meetmytech.com')
                    ->from('admin@meetmytech.com', 'MeetMyTech Test')
                    ->subject('SMTP Test - ' . date('Y-m-d H:i:s'));
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Test email sent successfully!',
            'config' => $config,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'config' => $config ?? 'Failed to load config',
            'error_type' => get_class($e),
            'timestamp' => date('Y-m-d H:i:s')
        ], 500);
    }
});

// Test forgot password email template
Route::get('/test-forgot-password-email', function () {
    $testUser = (object) [
        'name' => 'Test User',
        'email' => 'test@example.com'
    ];

    $testData = [
        'user' => $testUser,
        'newPassword' => 'TestPass123!',
        'loginUrl' => route('login')
    ];

    return view('emails.forgot-password', $testData);
});

// Test actual forgot password email sending
Route::get('/test-send-forgot-password', function () {
    try {
        $testUser = (object) [
            'name' => 'Test User',
            'email' => 'admin@meetmytech.com' // Send to your own email for testing
        ];

        $testData = [
            'user' => $testUser,
            'newPassword' => 'TestPass123!',
            'loginUrl' => route('login')
        ];

        Mail::send('emails.forgot-password', $testData, function($message) use ($testUser) {
            $message->to($testUser->email)
                    ->from('admin@meetmytech.com', 'MeetMyTech Support')
                    ->subject('Test: Your New Password - MeetMyTech');
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Test forgot password email sent successfully!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to send email: ' . $e->getMessage()
        ], 500);
    }
});

?>
