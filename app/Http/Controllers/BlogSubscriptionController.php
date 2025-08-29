<?php

namespace App\Http\Controllers;

use App\Models\BlogSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BlogSubscriptionController extends Controller
{
    /**
     * Subscribe to blog notifications
     */
    public function subscribe(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:255',
                'g-recaptcha-response' => 'required|captcha',
            ], [
                'email.required' => 'Email address is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.max' => 'Email address must not exceed 255 characters.',
                'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
                'g-recaptcha-response.captcha' => 'reCAPTCHA verification failed, please try again.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $email = $request->email;

            // Check if email already exists
            $subscriber = BlogSubscriber::findByEmail($email);

            if ($subscriber) {
                if ($subscriber->is_subscribed) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This email is already subscribed to blog notifications.'
                    ], 409);
                } else {
                    // Resubscribe
                    $subscriber->subscribe();

                    Log::info('Blog subscription reactivated', [
                        'email' => $email,
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->userAgent()
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Welcome back! You have been resubscribed to our blog notifications.'
                    ]);
                }
            }

            // Create new subscription
            BlogSubscriber::create([
                'email' => $email,
                'is_subscribed' => true,
                'subscribed_at' => now(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            Log::info('New blog subscription created', [
                'email' => $email,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for subscribing! You will receive notifications when new blogs are published.'
            ]);

        } catch (\Exception $e) {
            Log::error('Blog subscription error: ' . $e->getMessage(), [
                'email' => $request->email ?? 'unknown',
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error processing your subscription. Please try again later.'
            ], 500);
        }
    }

    /**
     * Unsubscribe from blog notifications
     */
    public function unsubscribe(Request $request, $token)
    {
        try {
            $subscriber = BlogSubscriber::findByToken($token);

            if (!$subscriber) {
                return view('emails.unsubscribe-result', [
                    'success' => false,
                    'message' => 'Invalid unsubscribe link. The subscription may have already been removed.'
                ]);
            }

            if (!$subscriber->is_subscribed) {
                return view('emails.unsubscribe-result', [
                    'success' => true,
                    'message' => 'You have already been unsubscribed from our blog notifications.',
                    'email' => $subscriber->email
                ]);
            }

            $subscriber->unsubscribe();

            Log::info('Blog subscription cancelled', [
                'email' => $subscriber->email,
                'token' => $token,
                'ip_address' => $request->ip()
            ]);

            return view('emails.unsubscribe-result', [
                'success' => true,
                'message' => 'You have been successfully unsubscribed from our blog notifications.',
                'email' => $subscriber->email
            ]);

        } catch (\Exception $e) {
            Log::error('Blog unsubscribe error: ' . $e->getMessage(), [
                'token' => $token,
                'trace' => $e->getTraceAsString()
            ]);

            return view('emails.unsubscribe-result', [
                'success' => false,
                'message' => 'Sorry, there was an error processing your unsubscribe request. Please try again later.'
            ]);
        }
    }

    /**
     * Get subscription status for email
     */
    public function status(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $isSubscribed = BlogSubscriber::isSubscribed($request->email);

        return response()->json([
            'subscribed' => $isSubscribed
        ]);
    }
}
