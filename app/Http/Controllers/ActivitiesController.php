<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Http\Requests\ProfessionalSkillsRequest;
use App\Services\ActivitiesService;
use Exception;

class ActivitiesController extends Controller
{
    /**
     * @var ActivitiesService
     */
    protected $activitiesService;

    /**
     * Create a new controller instance.
     *
     * @param ActivitiesService $activitiesService
     */
    public function __construct(ActivitiesService $activitiesService)
    {
        $this->activitiesService = $activitiesService;
    }

    /**
     * Display the activities page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $activitiesData = $this->activitiesService->getActivitiesData();
        $skillsDefaults = $this->activitiesService->getProfessionalSkillsWithDefaults();
        
        return view('Users.Pages.activities', [
            'user' => $activitiesData['user'],
            'activities' => $activitiesData['activities'],
            'professionalSkills' => $activitiesData['professionalSkills'],
            'skillsDefaults' => $skillsDefaults,
            'hasActivities' => $this->activitiesService->hasActivities(),
            'activitiesCount' => $this->activitiesService->getActivitiesCount(),
        ]);
    }

    /**
     * Store or update an activity.
     *
     * @param ActivityRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveOrUpdateActivity(ActivityRequest $request)
    {
        try {
            $isUpdate = $request->has('id') && !empty($request->input('id'));
            
            if ($isUpdate) {
                $this->activitiesService->updateActivity($request->input('id'), $request->validated());
                $message = 'Activity updated successfully!';
            } else {
                $this->activitiesService->createActivity($request->validated());
                $message = 'Activity added successfully!';
            }
            
            return redirect()
                ->back()
                ->with('success', $message);
                
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to save activity. Please try again.');
        }
    }

    /**
     * Update professional skills.
     *
     * @param ProfessionalSkillsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfessionalSkills(ProfessionalSkillsRequest $request)
    {
        try {
            $this->activitiesService->updateProfessionalSkills($request->validated());
            
            return redirect()
                ->back()
                ->with('success', 'Professional skills updated successfully.');
                
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update professional skills. Please try again.');
        }
    }

    /**
     * Delete an activity.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteActivity($id)
    {
        try {
            $this->activitiesService->deleteActivity($id);
            
            return redirect()
                ->back()
                ->with('success', 'Activity deleted successfully.');
                
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to delete activity. Please try again.');
        }
    }
}
