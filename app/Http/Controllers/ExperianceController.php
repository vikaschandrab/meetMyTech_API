<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WorkExperienceService;
use App\Http\Requests\WorkExperienceRequest;
use Illuminate\Support\Facades\Log;

class ExperianceController extends Controller
{
    protected $workExperienceService;

    /**
     * Constructor to inject WorkExperienceService
     *
     * @param WorkExperienceService $workExperienceService
     */
    public function __construct(WorkExperienceService $workExperienceService)
    {
        $this->middleware('auth');
        $this->workExperienceService = $workExperienceService;
    }

    /**
     * Display work experience page with user's work experiences
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $workExperiences = $this->workExperienceService->getUserWorkExperiences();
            $hasExperiences = $workExperiences && count($workExperiences) > 0;
            $experienceCount = $workExperiences ? count($workExperiences) : 0;

            return view('Users.Pages.experiance', compact('workExperiences', 'hasExperiences', 'experienceCount'));
        } catch (\Exception $e) {
            Log::error('Error loading work experience page: ' . $e->getMessage());

            return view('Users.Pages.experiance', [
                'workExperiences' => collect(),
                'hasExperiences' => false,
                'experienceCount' => 0
            ])->with('error', 'Unable to load work experiences. Please try again.');
        }
    }

    /**
     * Store a new work experience
     *
     * @param WorkExperienceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addWorkExperience(WorkExperienceRequest $request)
    {
        try {
            $workExperience = $this->workExperienceService->addWorkExperience($request->validated());

            if ($workExperience) {
                return redirect()->route('experiance')
                               ->with('success', 'Work experience added successfully!');
            } else {
                return redirect()->route('experiance')
                               ->with('error', 'Failed to add work experience. Please try again.');
            }
        } catch (\Exception $e) {
            Log::error('Error adding work experience: ' . $e->getMessage());
            return redirect()->route('experiance')
                           ->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    /**
     * Update an existing work experience
     *
     * @param WorkExperienceRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WorkExperienceRequest $request, $id)
    {
        try {
            $workExperience = $this->workExperienceService->updateWorkExperience($id, $request->validated());

            if ($workExperience) {
                return redirect()->route('experiance')
                               ->with('success', 'Work experience updated successfully!');
            } else {
                return redirect()->route('experiance')
                               ->with('error', 'Work experience not found or you do not have permission to update it.');
            }
        } catch (\Exception $e) {
            Log::error('Error updating work experience: ' . $e->getMessage());
            return redirect()->route('experiance')
                           ->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    /**
     * Delete a work experience
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        try {
            $deleted = $this->workExperienceService->deleteWorkExperience($id);

            if ($deleted) {
                return redirect()->route('experiance')
                               ->with('success', 'Work experience deleted successfully!');
            } else {
                return redirect()->route('experiance')
                               ->with('error', 'Work experience not found or you do not have permission to delete it.');
            }
        } catch (\Exception $e) {
            Log::error('Error deleting work experience: ' . $e->getMessage());

            return redirect()->route('experiance')
                           ->with('error', 'An unexpected error occurred. Please try again.');
        }
    }
}
