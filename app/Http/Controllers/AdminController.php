<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blog;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\NewUserWelcome;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display the admin dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_blogs' => Blog::count(),
            'recent_users' => User::latest()->take(5)->get(),
            'recent_blogs' => Blog::latest()->take(5)->get(),
            'user_activities' => UserActivity::with('user')->latest()->take(10)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Display users management page
     */
    public function users()
    {
        $users = User::with(['activities' => function($query) {
            $query->latest()->take(3);
        }])->paginate(20);

        return view('admin.users', compact('users'));
    }

    /**
     * Show create user form
     */
    public function createUser()
    {
        return view('admin.create-user');
    }

    /**
     * Store new user
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        // Generate auto password (8 characters: mix of uppercase, lowercase, numbers)
        $autoPassword = $this->generateSecurePassword();

        // Generate unique slug from name
        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $counter = 1;

        // Check if slug exists and make it unique
        while (User::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($autoPassword); // Encrypted password
        $user->user_type = 'user'; // Always user type
        $user->status = 'active';
        $user->slug = $slug; // Auto-generated unique slug
        $user->save();

        // Send welcome email with auto-generated password
        try {
            Mail::to($user->email)->send(new NewUserWelcome($user, $autoPassword));
            $emailStatus = 'Email sent successfully with login credentials.';
        } catch (\Exception $e) {
            $emailStatus = 'User created but email could not be sent. Please provide password manually: ' . $autoPassword;
        }

        return redirect()->route('admin.users')->with('success', 'User created successfully! ' . $emailStatus);
    }

    /**
     * Generate secure password
     */
    private function generateSecurePassword($length = 12)
    {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $symbols = '!@#$%&*';

        // Ensure at least one character from each type
        $password = '';
        $password .= $uppercase[rand(0, strlen($uppercase) - 1)];
        $password .= $lowercase[rand(0, strlen($lowercase) - 1)];
        $password .= $numbers[rand(0, strlen($numbers) - 1)];
        $password .= $symbols[rand(0, strlen($symbols) - 1)];

        // Fill the rest randomly
        $allChars = $uppercase . $lowercase . $numbers . $symbols;
        for ($i = 4; $i < $length; $i++) {
            $password .= $allChars[rand(0, strlen($allChars) - 1)];
        }

        // Shuffle the password
        return str_shuffle($password);
    }

    /**
     * Display specific user details
     */
    public function userDetails($id)
    {
        $user = User::with(['userDetail', 'educationDetails', 'workExperiences',
                           'userProfessionalSkills', 'activities'])
                   ->findOrFail($id);

        return view('admin.user-details', compact('user'));
    }

    /**
     * Update user status (activate/deactivate)
     */
    public function updateUserStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User status updated successfully'
        ]);
    }

    /**
     * Display blogs management page
     */
    public function blogs()
    {
        $blogs = Blog::latest()->paginate(20);
        return view('admin.blogs', compact('blogs'));
    }

    /**
     * Create new blog
     */
    public function createBlog()
    {
        return view('admin.create-blog');
    }

    /**
     * Store new blog
     */
    public function storeBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'blog_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->status = $request->status ?? 'active';

        if ($request->hasFile('blog_image')) {
            $image = $request->file('blog_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('blog_images', $imageName, 'public');
            $blog->blog_image = 'blog_images/' . $imageName;
        }

        $blog->save();

        return redirect()->route('admin.blogs')->with('success', 'Blog created successfully');
    }

    /**
     * Edit blog
     */
    public function editBlog($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.edit-blog', compact('blog'));
    }

    /**
     * Update blog
     */
    public function updateBlog(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'blog_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->status = $request->status ?? 'active';

        if ($request->hasFile('blog_image')) {
            $image = $request->file('blog_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('blog_images', $imageName, 'public');
            $blog->blog_image = 'blog_images/' . $imageName;
        }

        $blog->save();

        return redirect()->route('admin.blogs')->with('success', 'Blog updated successfully');
    }

    /**
     * Delete blog
     */
    public function deleteBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully'
        ]);
    }

    /**
     * Display site settings
     */
    public function settings()
    {
        return view('admin.settings');
    }

    /**
     * Display system logs
     */
    public function logs(Request $request)
    {
        $logsPath = storage_path('logs');
        $activityFilter = $request->get('activity', 'all');
        $dateFilter = $request->get('date', 'all');
        
        // Get all custom log files
        $logFiles = glob($logsPath . '/*.log');
        $customLogs = [];
        $activities = [];
        
        foreach ($logFiles as $file) {
            $filename = basename($file);
            
            // Skip laravel.log as it's the default log
            if ($filename === 'laravel.log') {
                continue;
            }
            
            // Extract activity name and date from filename (e.g., authentication-2025-08-26.log)
            if (preg_match('/^(.+)-(\d{4}-\d{2}-\d{2})\.log$/', $filename, $matches)) {
                $activityName = $matches[1];
                $logDate = $matches[2];
                
                // Add to activities list for filter
                if (!in_array($activityName, $activities)) {
                    $activities[] = $activityName;
                }
                
                // Apply filters
                if ($activityFilter !== 'all' && $activityFilter !== $activityName) {
                    continue;
                }
                
                if ($dateFilter !== 'all' && $dateFilter !== $logDate) {
                    continue;
                }
                
                // Read log file content
                if (file_exists($file) && is_readable($file)) {
                    $content = file_get_contents($file);
                    $lines = explode("\n", trim($content));
                    
                    foreach ($lines as $line) {
                        if (!empty(trim($line))) {
                            // Parse log line (assuming format: [timestamp] level: message)
                            if (preg_match('/^\[([^\]]+)\]\s+(\w+):\s+(.+)$/', $line, $logMatches)) {
                                $customLogs[] = [
                                    'activity' => $activityName,
                                    'date' => $logDate,
                                    'timestamp' => $logMatches[1] ?? null,
                                    'level' => $logMatches[2] ?? 'info',
                                    'message' => $logMatches[3] ?? $line,
                                    'filename' => $filename,
                                    'raw_line' => $line
                                ];
                            } else {
                                // Fallback for lines that don't match the pattern
                                $customLogs[] = [
                                    'activity' => $activityName,
                                    'date' => $logDate,
                                    'timestamp' => null,
                                    'level' => 'info',
                                    'message' => $line,
                                    'filename' => $filename,
                                    'raw_line' => $line
                                ];
                            }
                        }
                    }
                }
            }
        }
        
        // Sort logs by timestamp (newest first)
        usort($customLogs, function($a, $b) {
            $timeA = $a['timestamp'] ? strtotime($a['timestamp']) : 0;
            $timeB = $b['timestamp'] ? strtotime($b['timestamp']) : 0;
            return $timeB - $timeA;
        });
        
        // Group logs by activity for better organization
        $groupedLogs = [];
        foreach ($customLogs as &$log) {
            $log['activity_icon'] = $this->getActivityIcon($log['activity']);
            $log['activity_color'] = $this->getActivityColor($log['activity']);
            $log['level_color'] = $this->getLevelColor($log['level']);
            $groupedLogs[$log['activity']][] = $log;
        }
        
        // Paginate custom logs
        $perPage = 50;
        $currentPage = request()->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $paginatedLogs = array_slice($customLogs, $offset, $perPage);
        
        // Get available dates for filter
        $availableDates = [];
        foreach ($logFiles as $file) {
            $filename = basename($file);
            if (preg_match('/^.+-(\d{4}-\d{2}-\d{2})\.log$/', $filename, $matches)) {
                $date = $matches[1];
                if (!in_array($date, $availableDates)) {
                    $availableDates[] = $date;
                }
            }
        }
        sort($availableDates);
        $availableDates = array_reverse($availableDates); // Newest first
        
        // Also get database logs for comparison
        $databaseLogs = UserActivity::with('user')->latest()->take(20)->get();
        
        return view('admin.logs', compact(
            'customLogs', 
            'groupedLogs', 
            'paginatedLogs', 
            'activities', 
            'availableDates',
            'activityFilter', 
            'dateFilter',
            'databaseLogs'
        ));
    }

    /**
     * Helper function to get activity icon
     */
    private function getActivityIcon($activity)
    {
        $icons = [
            'authentication' => 'user-shield',
            'blog' => 'blog',
            'dashboard' => 'tachometer-alt',
            'database' => 'database',
            'profile' => 'user-edit',
            'security' => 'shield-alt',
            'site_settings' => 'cogs',
        ];
        return $icons[$activity] ?? 'file-alt';
    }

    /**
     * Helper function to get activity color
     */
    private function getActivityColor($activity)
    {
        $colors = [
            'authentication' => 'primary',
            'blog' => 'success',
            'dashboard' => 'info',
            'database' => 'warning',
            'profile' => 'secondary',
            'security' => 'danger',
            'site_settings' => 'dark',
        ];
        return $colors[$activity] ?? 'light';
    }

    /**
     * Helper function to get log level color
     */
    private function getLevelColor($level)
    {
        $colors = [
            'debug' => 'secondary',
            'info' => 'info',
            'notice' => 'primary',
            'warning' => 'warning',
            'error' => 'danger',
            'critical' => 'danger',
            'alert' => 'danger',
            'emergency' => 'danger',
        ];
        return $colors[strtolower($level)] ?? 'light';
    }
}
