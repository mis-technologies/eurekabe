<?php

namespace Modules\Explore\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Exam\Models\Exam;
use Illuminate\Http\Request;
use Modules\Common\Models\School;
use Modules\Exam\Models\ExamFeedback;
use Modules\Exam\Models\Subject;
use Modules\Student\Models\StudentFavoriteExam;

class ExploreExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Initialize query builder for Exam
        $query = Exam::query();

        // Filtering (e.g., by subject or level)
        if ($request->has('subject')) {
            if($subject = Subject::where('name', $request->get('subject'))->orWhere('id', $request->get('subject'))->first() ){
                $query->where('subject_id', $subject->id);
            }   
           
        }


        // Filtering (e.g., by subject or level)
        if ($request->has('school')) {
            if($school = School::where('acronym', $request->get('school'))->orWhere('id', $request->get('school' ))->first() ){
                $query->where('school_id', $school->id);
            }   
           
        }

        if ($request->has('level')) {
            $query->where('level', $request->get('level')); // 100, 200, 300, 400, 500, 600, 700, 800, 900, 1000
        }

        // Searching (e.g., search by title or description)
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
                //   ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sorting
        if ($request->has('sort_by') && in_array($request->get('sort_by'), ['title', 'created_at'])) {
            $sortOrder = $request->get('sort_order', 'asc'); // default to ascending order
            $query->orderBy($request->get('sort_by'), $sortOrder);
        }

        // Pagination
        $perPage = $request->get('per_page', 10);


        $exams = $query->paginate($perPage);



        // Return API response
        return response()->json([
            'success' => true,
            'data' => $exams,
        ], 200);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        // Retrieve the exam by ID
        $exam = Exam::find($id);

        // Check if exam exists
        if (!$exam) {
            return response()->json([
                'success' => false,
                'message' => 'Exam not found.',
            ], 404);
        }

        // Return the exam data
        return response()->json([
            'success' => true,
            'data' => $exam,
        ], 200);
    }


    /**
     * Get featured exams.
     */
    public function featured()
    {
        // Retrieve exams marked as featured
        $exams = Exam::where('is_featured', true)->get();

        // Return API response
        return response()->json([
            'success' => true,
            'data' => $exams,
        ], 200);
    }

    /**
     * Get popular exams.
     */
    public function popular()
    {
        // Retrieve exams based on a popularity metric, e.g., number of views or enrollments
        $exams = Exam::orderBy('popularity', 'desc')->limit(10)->get();

        // Return API response
        return response()->json([
            'success' => true,
            'data' => $exams,
        ], 200);
    }

    /**
     * Get recommended exams based on some criteria.
     */
    public function recommend()
    {
        // Retrieve recommended exams based on user preferences, past performance, or similar criteria
        $recommendedExams = Exam::where('recommended', true)->get();

        // Return API response
        return response()->json([
            'success' => true,
            'data' => $recommendedExams,
        ], 200);
    }



     /**
     * Add exam to favorite
    */
    public function addExamToFavorite(Request $request)
    {
        $user = auth()->user();
        if (!$exam = Exam::find($request->exam_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Exam not found',
            ], 404);
        }

        $favorite = StudentFavoriteExam::create([
            'user_id' => $user->id,
            'exam_id' => $exam->id,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Exam added to favorite successfully',
            'data' => $favorite,
        ]);

    }


    // method to retrieve exam feedbacks
    public function getExamFeedbacks($exam_id)
    {
        $exam = Exam::find($exam_id);
        if (!$exam) {
            return response()->json([
                'success' => false,
                'message' => 'Exam not found',
            ], 404);
        }

        $feedbacks = ExamFeedback::where('exam_id', $exam->id)->paginate(50);
        return response()->json([
            'success' => true,
            'data' => $feedbacks,
        ]);
    }






}
