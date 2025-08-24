<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Log;

class VikasProfileController extends Controller
{
    /**
     * Display the portfolio homepage with latest blogs
     *
     * @return \Illuminate\View\View
     */
    public function homePage()
    {
        try {
            $designs = ['Vikas.Design_1_restructured', 'Vikas.Design_2_restructured']; // Updated to use restructured versions
            $randomDesign = $designs[array_rand($designs)];   // Pick one randomly

            // Get latest published blogs for the homepage (limit to 3)
            $blogs = Blog::where('status', 'published')
                        ->orderBy('created_at', 'desc')
                        ->with(['category', 'tags'])
                        ->limit(3)
                        ->get();

            // Add read time calculation if not already present
            $blogs = $blogs->map(function ($blog) {
                if (!$blog->read_time) {
                    $wordCount = str_word_count(strip_tags($blog->content));
                    $blog->read_time = max(1, ceil($wordCount / 200)); // Average reading speed
                }
                return $blog;
            });

            // Prepare data for the view
            $viewData = [
                'blogs' => $blogs,
                'skills' => $this->getSkillsData(),
                'education' => $this->getEducationData(),
                'workExperience' => $this->getWorkExperienceData()
            ];

            return view($randomDesign, $viewData);
        } catch (\Exception $e) {
            Log::error('Failed to load homepage with blogs: ' . $e->getMessage(), [
                'exception' => $e,
                'action' => 'homepage_load'
            ]);

            // Fallback to design without blogs if there's an error
            $designs = ['Vikas.Design_1_restructured', 'Vikas.Design_2_restructured'];
            $randomDesign = $designs[array_rand($designs)];

            return view($randomDesign, [
                'blogs' => collect(),
                'skills' => $this->getSkillsData(),
                'education' => $this->getEducationData(),
                'workExperience' => $this->getWorkExperienceData()
            ]);
        }
    }

    /**
     * Display all blogs page
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function blogs(Request $request)
    {
        try {
            $query = Blog::where('status', 'published')
                        ->with(['category', 'tags'])
                        ->orderBy('created_at', 'desc');

            // Add search functionality
            if ($request->has('search') && $request->search) {
                $searchTerm = $request->search;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('content', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('excerpt', 'LIKE', "%{$searchTerm}%");
                });
            }

            // Add category filter
            if ($request->has('category') && $request->category) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });
            }

            $blogs = $query->paginate(9);

            // Add read time calculation
            $blogs->getCollection()->transform(function ($blog) {
                if (!$blog->read_time) {
                    $wordCount = str_word_count(strip_tags($blog->content));
                    $blog->read_time = max(1, ceil($wordCount / 200));
                }
                return $blog;
            });

            return view('Vikas.pages.blogs', compact('blogs'));
        } catch (\Exception $e) {
            Log::error('Failed to load blogs page: ' . $e->getMessage(), [
                'exception' => $e,
                'action' => 'blogs_page_load'
            ]);

            return view('Vikas.pages.blogs', ['blogs' => collect()]);
        }
    }

    /**
     * Display a specific blog post
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function showBlog($slug)
    {
        try {
            $blog = Blog::where('slug', $slug)
                       ->orWhere('id', $slug)
                       ->where('status', 'published')
                       ->with(['category', 'tags'])
                       ->firstOrFail();

            // Get related blogs
            $relatedBlogs = Blog::where('status', 'published')
                               ->where('id', '!=', $blog->id)
                               ->when($blog->category, function ($query) use ($blog) {
                                   return $query->where('category_id', $blog->category->id);
                               })
                               ->orderBy('created_at', 'desc')
                               ->limit(3)
                               ->get();

            return view('Vikas.pages.blog-detail', compact('blog', 'relatedBlogs'));
        } catch (\Exception $e) {
            Log::error('Failed to load blog detail: ' . $e->getMessage(), [
                'exception' => $e,
                'slug' => $slug,
                'action' => 'blog_detail_load'
            ]);

            return redirect()->route('blogs.index')->with('error', 'Blog post not found.');
        }
    }

    /**
     * Get skills data for the portfolio
     *
     * @return array
     */
    private function getSkillsData()
    {
        return [
            // This could be moved to a config file or database
            ['name' => 'PHP Development', 'percentage' => 95],
            ['name' => 'Laravel Framework', 'percentage' => 92],
            ['name' => 'JavaScript', 'percentage' => 88],
            ['name' => 'MySQL Database', 'percentage' => 90],
            ['name' => 'Vue.js', 'percentage' => 85],
            ['name' => 'React Native', 'percentage' => 78],
            ['name' => 'UI/UX Design', 'percentage' => 82],
        ];
    }

    /**
     * Get education data for the portfolio
     *
     * @return array
     */
    private function getEducationData()
    {
        return [
            // This could be moved to a config file or database
            [
                'degree' => 'Master of Computer Applications',
                'year' => '2016-2019',
                'institution' => 'University Name',
                'description' => 'Specialized in software development and database management.'
            ],
            [
                'degree' => 'Bachelor of Computer Science',
                'year' => '2013-2016',
                'institution' => 'College Name',
                'description' => 'Foundation in programming and computer science principles.'
            ]
        ];
    }

    /**
     * Get work experience data for the portfolio
     *
     * @return array
     */
    private function getWorkExperienceData()
    {
        return [
            // This could be moved to a config file or database
            [
                'position' => 'Senior PHP Developer',
                'period' => '2021 - Present',
                'company' => 'Tech Company Ltd.',
                'description' => 'Leading development of web applications using Laravel and Vue.js.',
                'achievements' => [
                    'Developed and maintained multiple web applications',
                    'Led a team of 3 junior developers',
                    'Improved application performance by 40%'
                ]
            ],
            [
                'position' => 'PHP Developer',
                'period' => '2019 - 2021',
                'company' => 'Software Solutions Inc.',
                'description' => 'Developed web applications and APIs using PHP and MySQL.',
                'achievements' => [
                    'Built RESTful APIs for mobile applications',
                    'Integrated third-party services and payment gateways',
                    'Optimized database queries for better performance'
                ]
            ],
            [
                'position' => 'Junior Web Developer',
                'period' => '2018 - 2019',
                'company' => 'Startup Technologies',
                'description' => 'Started career developing websites and learning modern frameworks.',
                'achievements' => [
                    'Created responsive websites using HTML, CSS, and JavaScript',
                    'Learned Laravel framework and best practices',
                    'Contributed to open-source projects'
                ]
            ]
        ];
    }
}
