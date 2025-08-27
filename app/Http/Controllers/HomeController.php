<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\HomeService;
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
        
        return view('home.index', $data);
    }

    /**
     * Display all blogs page
     */
    public function allBlogs(Request $request)
    {
        $blogs = $this->homeService->getFilteredBlogs($request);
        $popularTags = $this->homeService->getPopularTags();

        return view('home.all-blogs', compact('blogs', 'popularTags'));
    }
}
