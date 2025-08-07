<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\ProfileService;
use App\Services\LoggingService;
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
        LoggingService::logProfile('profile_view', 'User viewed their profile page');

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
            LoggingService::logProfile('profile_update_attempt', 'User attempting to update profile', [
                'updated_fields' => array_keys($request->validated())
            ]);

            $this->profileService->updateProfile($request->validated());

            LoggingService::logProfile('profile_update_success', 'Profile updated successfully', [
                'updated_fields' => array_keys($request->validated())
            ]);

            return redirect()
                ->back()
                ->with('success', 'Profile updated successfully.');

        } catch (Exception $e) {
            LoggingService::logError($e, 'profile', [
                'action' => 'profile_update_failed',
                'form_data' => $request->except(['profile_pic', 'password'])
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $e->getMessage() . ' Failed to update profile. Please try again.');
        }
    }
}
