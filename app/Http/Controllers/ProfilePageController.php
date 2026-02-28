<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogCommentRequest;
use Illuminate\Http\Request;
use App\Services\PublicBlogService;
use App\Services\PublicProfileService;

class ProfilePageController extends Controller
{
    public function __construct(
        private PublicBlogService $publicBlogService,
        private PublicProfileService $publicProfileService
    ) {}

    public function show($slug)
    {
        if ($slug === 'www.meetmytech.com') {
            return redirect()->to('https://meetmytech.com', 301);
        }

        return view('ProfileWebsite.Design_1', $this->publicProfileService->getProfilePageData($slug));
    }

    /**
     * Display the specified blog for public viewing
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function publicShow(string $slug, Request $request)
    {
        return view('public.blogs.show', $this->publicBlogService->getPublicBlogPageData($slug, $request));
    }

    /**
     * Store a new comment for a blog
     *
     * @param Request $request
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeComment(StoreBlogCommentRequest $request, string $slug)
    {
        $result = $this->publicBlogService->storeComment($slug, $request->validated());

        if (!$result['success']) {
            return redirect()->back()->with('error', $result['message']);
        }

        return redirect()->back()->with('success', $result['message']);
    }
}
