<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InterviewQuestion;
use App\Services\InterviewQuestionImportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewQuestionsController extends Controller
{
    private array $allowedSlugs = ['vikas', 'jyothi', 'manikanta'];

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $slug = optional($request->user())->slug;
            if (!$slug || !in_array($slug, $this->allowedSlugs, true)) {
                abort(403, 'Interview questions section is not enabled for this account.');
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the interview questions.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();
        $questions = InterviewQuestion::where('user_id', $userId)
            ->latest()
            ->paginate(10);

        $hasQuestions = $questions->count() > 0;

        return view('Users.Pages.interviewQuestions.index', compact('questions', 'hasQuestions'));

    }

    public function create()
    {
        return view('Users.Pages.interviewQuestions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|min:10',
            'answer'   => 'nullable|string',
            'level'    => 'required|in:junior,mid,senior',
            'category' => 'nullable|string|max:100',
        ]);

        InterviewQuestion::create([
            'user_id'  => auth()->id(),
            'question' => $request->question,
            'answer'   => $request->answer,
            'level'    => $request->level,
            'category' => $request->category,
        ]);

        return redirect()
            ->route('interviewQuestions.index')
            ->with('success', 'Interview question added successfully!');
    }

    public function importForm()
    {
        return view('Users.Pages.interviewQuestions.import');
    }

    public function import(Request $request, InterviewQuestionImportService $importService)
    {
        $request->validate([
            'file'     => 'required|file|mimes:pdf,doc,docx,txt|max:10240',
            'level'    => 'nullable|in:junior,mid,senior',
            'category' => 'nullable|string|max:100',
        ]);

        $result = $importService->importFromUploadedFile(
            $request->file('file'),
            (int) $request->user()->id,
            $request->input('level', 'junior'),
            $request->input('category')
        );

        return redirect()
            ->route('interviewQuestions.index')
            ->with('success', "Imported {$result['created']} questions. Skipped {$result['skipped']}.");
    }
}
