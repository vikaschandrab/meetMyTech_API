<?php

namespace App\Services;

use App\Helpers\ModelAttributeHelper;
use App\Models\User;

class PublicProfileService
{
    /**
     * Build profile page payload for the public profile view.
     */
    public function getProfilePageData(string $slug): array
    {
        $userDetails = User::query()
            ->with(['SiteSettings', 'userActivity', 'detail', 'userProfessionalSkills'])
            ->where('slug', $slug)
            ->first();

        abort_unless($userDetails, 404, 'User not found');
        abort_if($userDetails->status !== 'active', 403, 'This profile is not available. The user account is inactive.');

        $this->appendLegacyAttributes($userDetails);

        $educationDetails = $userDetails->educationDetails()
            ->latest('created_at')
            ->get();

        $workExperiences = $userDetails->workExperiences()
            ->orderByRaw('to_date IS NULL DESC')
            ->latest('created_at')
            ->get();

        $blogs = $userDetails->blogs()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->get();

        return [
            'UserDetails' => $userDetails,
            'EducationDetails' => $educationDetails,
            'WorkExperiences' => $workExperiences,
            'blogs' => $blogs,
        ];
    }

    /**
     * Keep old blade compatibility by flattening related data into UserDetails.
     */
    private function appendLegacyAttributes(User $user): void
    {
        ModelAttributeHelper::mergeModelAttributes($user, $user->SiteSettings->first());
        ModelAttributeHelper::mergeGroupedCollectionAttributes($user, $user->userActivity);
        ModelAttributeHelper::mergeModelAttributes($user, $user->detail);
        ModelAttributeHelper::mergeModelAttributes($user, $user->userProfessionalSkills->first());
    }
}
