<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\LoggingService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function index(){
        LoggingService::logAuth('login_page_view', 'User viewed login page');
        return view('Users.login');
    }

    public function login(Request $request)
    {
        // Base validation rules
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $messages = [
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
        ];

        // Add captcha validation only if not in local environment or if captcha is explicitly enabled
        if (!app()->environment('local') || !config('captcha.disable_in_local', false)) {
            $rules['g-recaptcha-response'] = 'required|captcha';
            $messages['g-recaptcha-response.required'] = 'Please verify that you are not a robot.';
            $messages['g-recaptcha-response.captcha'] = 'reCAPTCHA verification failed, please try again.';
        }

        $request->validate($rules, $messages);

        LoggingService::logAuth('login_attempt', 'User attempting to login', [
            'email' => $request->email
        ]);

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Check user_type - allow both user and admin
            if (!in_array($user->user_type, ['user', 'admin'])) {
                Auth::logout(); // logout immediately

                LoggingService::logSecurity('warning', 'Unauthorized user type attempted login', [
                    'email' => $request->email,
                    'user_type' => $user->user_type
                ]);

                return redirect()->back()->withErrors(['email' => 'Unauthorized user type.']);
            }

            // Check if user account is active
            if ($user->status !== 'active') {
                Auth::logout(); // logout immediately

                LoggingService::logSecurity('warning', 'Inactive user attempted login', [
                    'email' => $request->email,
                    'user_id' => $user->id,
                    'status' => $user->status
                ]);

                return redirect()->back()->withErrors(['email' => 'Your account is inactive. Please contact support for assistance.']);
            }

            // Regenerate session to prevent fixation
            $request->session()->regenerate();

            LoggingService::logAuth('login_success', 'User successfully logged in', [
                'user_id' => $user->id,
                'email' => $user->email
            ]);

            // Add success message
            session()->flash('message', 'Welcome back! You have been successfully logged in.');
            session()->flash('message_type', 'success');

            // Redirect based on user type
            if ($user->user_type === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->intended('/dashboard');
            }
        }

        // If login failed
        LoggingService::logSecurity('warning', 'Failed login attempt', [
            'email' => $request->email,
            'ip_address' => $request->ip()
        ]);

        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        LoggingService::logAuth('logout', 'User logged out', [
            'user_id' => $user?->id,
            'email' => $user?->email
        ]);

        Auth::logout(); // logs out the user

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token to prevent session fixation
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'You have been logged out successfully.');
    }

    /**
     * Show forgot password form
     */
    public function showForgotPasswordForm()
    {
        LoggingService::logAuth('forgot_password_page_view', 'User viewed forgot password page');
        return view('Users.forgot-password');
    }

    /**
     * Handle forgot password request
     */
    public function forgotPassword(Request $request)
    {
        // Base validation rules
        $rules = [
            'email' => 'required|email',
        ];

        $messages = [
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
        ];

        // Add captcha validation only if not in local environment or if captcha is explicitly enabled
        if (!app()->environment('local') || !config('captcha.disable_in_local', false)) {
            $rules['g-recaptcha-response'] = 'required|captcha';
            $messages['g-recaptcha-response.required'] = 'Please verify that you are not a robot.';
            $messages['g-recaptcha-response.captcha'] = 'reCAPTCHA verification failed, please try again.';
        }

        $request->validate($rules, $messages);

        try {
            // Find user by email
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return back()->withErrors(['email' => 'No account found with this email address.']);
            }

            // Generate new random password
            $newPassword = Str::random(12) . rand(10, 99); // 12 chars + 2 digits

            // Update user's password
            $user->password = Hash::make($newPassword);
            $user->save();

            // Prepare email data
            $emailData = [
                'user' => $user,
                'newPassword' => $newPassword,
                'loginUrl' => route('login')
            ];

            // Send email with new password
            Mail::send('emails.forgot-password', $emailData, function($message) use ($user) {
                $message->to($user->email)
                        ->from('admin@meetmytech.com', 'MeetMyTech Support')
                        ->subject('Your New Password - MeetMyTech');
            });

            // Log the activity
            LoggingService::logAuth('forgot_password_success', 'Password reset sent to: ' . $user->email, ['user_id' => $user->id]);

            return back()->with('success', 'A new password has been sent to your email address. Please check your inbox and login with the new password.');

        } catch (\Exception $e) {
            LoggingService::logAuth('forgot_password_error', 'Failed to send password reset: ' . $e->getMessage());
            return back()->with('error', 'Sorry, there was an error processing your request. Please try again or contact support.');
        }
    }
}

