<?php

namespace App\Http\Controllers;

use App\Models\EducationDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Services\EducationService;
use App\Http\Requests\EducationRequest;

class EducationController extends Controller
{
    protected $educationService;

    public function __construct(EducationService $educationService)
    {
        $this->educationService = $educationService;
    }

    public function index()
    {
        try {
            $user = Auth::user();
            $education = $this->educationService->getUserEducation($user);
            $hasEducation = $education && count($education) > 0;
            $educationCount = $education ? count($education) : 0;
            
            return view('Users.Pages.education', compact('user', 'education', 'hasEducation', 'educationCount'));
        } catch (\Exception $e) {
            Log::error('Failed to load education data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while loading education data.');
        }
    }

    public function addEducation(EducationRequest $request)
    {
        try {
            $this->educationService->addEducation($request->validated());
            return redirect()->back()->with('success', 'Education added successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to save education: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while saving education.');
        }
    }

    public function update(EducationRequest $request, $id)
    {
        try {
            $this->educationService->updateEducation($id, $request->validated());
            return redirect()->back()->with('success', 'Education updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update education: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while updating education.');
        }
    }

    public function delete($id)
    {
        try {
            $this->educationService->deleteEducation($id);
            return redirect()->back()->with('success', 'Education deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to delete education: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong while deleting education.');
        }
    }
}
