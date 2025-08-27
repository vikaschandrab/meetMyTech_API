<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\HomeService;
use App\Services\DesignService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var HomeService
     */
    protected $homeService;

    /**
     * Create a new controller instance.
     */
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    /**
     * Display the homepage
     */
    public function index()
    {
        $data = $this->homeService->getHomepageData();

        // Session-based design template selection for homepage
        $selectedDesign = DesignService::getHomepageDesign();

        return view('home.' . $selectedDesign, $data);
    }

    /**
     * Display all blogs page
     */
    public function allBlogs(Request $request)
    {
        $blogs = $this->homeService->getFilteredBlogs($request);
        $popularTags = $this->homeService->getPopularTags();

        // Session-based design template selection
        $selectedDesign = DesignService::getBlogListingDesign();

        return view('home.' . $selectedDesign, compact('blogs', 'popularTags'));
    }
}
