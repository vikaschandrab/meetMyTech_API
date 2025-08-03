<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use Exception;

class ProfileController extends Controller
{
    /**
     * @var ProfileService
     */
    protected $profileService;

    /**
     * Create a new controller instance.
     *
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Display the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $profileData = $this->profileService->getProfileData();
        
        return view('Users.Pages.profile', [
            'user' => $profileData['user'],
            'details' => $profileData['details'],
            'socialProfiles' => $this->profileService->getSocialMediaProfiles($profileData['details'])
        ]);
    }

    /**
     * Update the user's profile.
     *
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userUpdate(UpdateProfileRequest $request)
    {
        try {
            $this->profileService->updateProfile($request->validated());
            
            return redirect()
                ->back()
                ->with('success', 'Profile updated successfully.');
                
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update profile. Please try again.');
        }
    }
}
