<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteSettingsRequest;
use App\Services\SiteSettingsService;
use Illuminate\Support\Facades\Auth;
use Exception;

class SiteSettingsController extends Controller
{
    protected $siteSettingsService;

    public function __construct(SiteSettingsService $siteSettingsService)
    {
        $this->middleware('auth');
        $this->siteSettingsService = $siteSettingsService;
    }

    /**
     * Display site settings page
     */
    public function index()
    {
        try {
            $siteSetting = $this->siteSettingsService->getUserSiteSettings();
            
            return view('Users.Pages.siteSettings', compact('siteSetting'));
        } catch (Exception $e) {
            return back()->with('error', 'Unable to load site settings. Please try again.');
        }
    }

    /**
     * Update site settings
     */
    public function update(SiteSettingsRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $siteSettings = $this->siteSettingsService->createOrUpdateSiteSettings($validatedData);

            if ($siteSettings) {
                return back()->with('success', 'Site settings updated successfully!');
            } else {
                return back()->with('error', 'Failed to update site settings. Please try again.');
            }

        } catch (Exception $e) {
            return back()->with('error', 'An error occurred while updating site settings. Please try again.');
        }
    }

    /**
     * Delete site settings
     */
    public function delete()
    {
        try {
            $deleted = $this->siteSettingsService->deleteSiteSettings();

            if ($deleted) {
                return back()->with('success', 'Site settings deleted successfully!');
            } else {
                return back()->with('error', 'Failed to delete site settings. Please try again.');
            }

        } catch (Exception $e) {
            return back()->with('error', 'An error occurred while deleting site settings. Please try again.');
        }
    }
}
