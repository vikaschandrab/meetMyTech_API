<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\MockInterviewService;
use Illuminate\Http\Request;

class MockInterviewController extends Controller
{
    protected $service;

    public function __construct(MockInterviewService $service)
    {
        $this->service = $service;
    }

    public function index(){
        return view ('home.mock-interview');
    }

    public function submitForm(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'date' => 'required|date',
            'time' => 'required',
            'experience' => 'required|string',
            'technology' => 'required|string',
            'notes' => 'nullable|string',
            'website' => 'honeypot', // honeypot validation (requires package or custom)
            'g-recaptcha-response' => 'required|captcha',
        ]);

        $this->service->handle($data);

        return redirect()->back()->with('success', 'Your mock interview request has been submitted successfully!');
    }
}
