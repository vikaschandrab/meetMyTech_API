<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Show the contact form
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Handle contact form submission
     */
    public function submit(Request $request)
    {
        // Base validation rules
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'personal_email' => 'required|email|max:255',
            'professional_email' => 'nullable|email|max:255',
            'current_organization' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'technologies' => 'required|string|max:1000',
        ];

        $messages = [];

        // Add captcha validation only if not in local environment or if captcha is explicitly enabled
        if (!app()->environment('local') || !config('captcha.disable_in_local', false)) {
            $rules['g-recaptcha-response'] = 'required|captcha';
            $messages['g-recaptcha-response.required'] = 'Please verify that you are not a robot.';
            $messages['g-recaptcha-response.captcha'] = 'reCAPTCHA verification failed, please try again.';
        }

        // Validate the form data including reCAPTCHA
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $data = $request->all();

            // Send email to contact.us@meetmytech.com
            Mail::send('emails.contact-inquiry', ['contactData' => $data], function($message) use ($data) {
                $message->to('contact.us@meetmytech.com')
                        ->from('admin@meetmytech.com', 'MeetMyTech Platform')
                        ->subject('New Contact Inquiry - ' . $data['first_name'] . ' ' . $data['last_name']);
            });

            // Send confirmation email to the user
            Mail::send('emails.contact-confirmation', ['contactData' => $data], function($message) use ($data) {
                $message->to($data['personal_email'])
                        ->from('admin@meetmytech.com', 'MeetMyTech Platform')
                        ->subject('Welcome to MeetMyTech - Your Journey Begins!');
            });

            return back()->with('success', 'Thank you for your interest! We have received your inquiry and will get back to you within 24 hours.');

        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());
            return back()->with('error', 'Sorry, there was an error sending your message. Please try again or contact us directly at contact.us@meetmytech.com');
        }
    }
}
