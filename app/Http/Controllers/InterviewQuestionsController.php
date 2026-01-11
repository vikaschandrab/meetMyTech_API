<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InterviewQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewQuestionsController extends Controller
{
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

        // return view('Users.Pages.interviewQuestions.interviewQuestions');
    }
}
