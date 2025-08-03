<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAboutRequest;
use App\Services\AboutService;
use Exception;

class AboutController extends Controller
{
    /**
     * @var AboutService
     */
    protected $aboutService;

    /**
     * Create a new controller instance.
     *
     * @param AboutService $aboutService
     */
    public function __construct(AboutService $aboutService)
    {
        $this->aboutService = $aboutService;
    }

    /**
     * Display the about page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $aboutData = $this->aboutService->getAboutData();
        
        return view('Users.Pages.about', [
            'user' => $aboutData['user'],
            'details' => $aboutData['details'],
            'technologies' => $this->aboutService->getFormattedTechnologies($aboutData['details']->technologies ?? null),
            'hasResume' => $this->aboutService->hasResume($aboutData['details']),
            'resumeUrl' => $this->aboutService->getResumeUrl($aboutData['details'])
        ]);
    }

    /**
     * Update the about section.
     *
     * @param UpdateAboutRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateAbout(UpdateAboutRequest $request)
    {
        try {
            $this->aboutService->updateAbout($request->validated());
            
            return redirect()
                ->back()
                ->with('success', 'About section updated successfully!');
                
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Something went wrong. Please try again.');
        }
    }
}
