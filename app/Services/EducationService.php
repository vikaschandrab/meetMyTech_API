<?php
namespace App\Services;

use App\Models\EducationDetail;
use Illuminate\Support\Facades\Auth;

class EducationService
{
    public function getUserEducation($user)
    {
        return $user->educationDetails;
    }

    public function addEducation($data)
    {
        $education = new EducationDetail();
        $education->user_id = Auth::id();
        $education->degree = $data['degree'];
        $education->percentage_or_cgpa = $data['precentage'];
        $education->from_date = $data['from_date'];
        $education->to_date = $data['to_date'];
        $education->university = $data['university'];
        $education->description = $data['description'];
        $education->save();
        return $education;
    }

    public function updateEducation($id, $data)
    {
        $education = EducationDetail::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $education->degree = $data['degree'];
        $education->percentage_or_cgpa = $data['precentage'];
        $education->from_date = $data['from_date'];
        $education->to_date = $data['to_date'];
        $education->university = $data['university'];
        $education->description = $data['description'];
        $education->save();
        return $education;
    }

    public function deleteEducation($id)
    {
        $education = EducationDetail::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $education->delete();
        return true;
    }
}
