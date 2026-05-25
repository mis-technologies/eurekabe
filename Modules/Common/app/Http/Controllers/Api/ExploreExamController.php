<?php

namespace Modules\Common\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Common\Models\Exam;
use Illuminate\Http\Request;
use Modules\Common\Models\School;
use Modules\Common\Models\ExamFeedback;
use Modules\Common\Models\Subject;
use Modules\Student\Models\StudentFavoriteExam;

class ExploreExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Initialize query builder for Exam
        $query = Exam::with(['school', 'subject']);

        $query->where('status', 1); // Only show exams that are active

        // filter out do not have  questions
        $query->whereHas('questions');

        // Apply visibility rules
        $user = auth('sanctum')->user();
        $query->where(function($q) use ($user) {
            // 1. public exams
            $q->where('visibility', 'public')
              ->orWhereNull('visibility');
            
            if ($user) {
                // 2. private exams: only students linked to that school
                $q->orWhere(function($q2) use ($user) {
                    $q2->where('visibility', 'private')
                       ->where('school_id', $user->school_id);
                });
                
                // 3. followers exams: students who follow the school or are linked
                $schoolIds = $user->schools()->pluck('schools.id')->toArray();
                if ($user->school_id) {
                    $schoolIds[] = $user->school_id;
                }
                
                if (!empty($schoolIds)) {
                    $q->orWhere(function($q3) use ($schoolIds) {
                        $q3->where('visibility', 'followers')
                           ->whereIn('school_id', $schoolIds);
                    });
                }
            }
        });

        // Filtering by subject(s)
        if ($request->has('subject')) {
            $subjectParam = $request->get('subject');
            $subjectList = is_array($subjectParam) ? $subjectParam : explode(',', $subjectParam);
            $subjectIds = Subject::whereIn('name', $subjectList)->orWhereIn('id', $subjectList)->pluck('id')->toArray();
            if (!empty($subjectIds)) {
                $query->whereIn('subject_id', $subjectIds);
            }
        }

        // Filtering by school(s)
        if ($request->has('school')) {
            $schoolParam = $request->get('school');
            $schoolList = is_array($schoolParam) ? $schoolParam : explode(',', $schoolParam);
            $schoolIds = School::whereIn('acronym', $schoolList)->orWhereIn('id', $schoolList)->pluck('id')->toArray();
            if (!empty($schoolIds)) {
                $query->whereIn('school_id', $schoolIds);
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
        $exam = Exam::with(['school'])->find($id);

        if ($exam) {
            $exam->attempts_count = \Modules\Student\Models\StudentExam::where('exam_id', $exam->id)->count();
            $exam->average_score = round(\Modules\Student\Models\StudentExam::where('exam_id', $exam->id)
                ->where('total_possible_marks', '>', 0)
                ->avg(\Illuminate\Support\Facades\DB::raw('(total_marks_earned / total_possible_marks) * 100')) ?? 0, 1);
        }

        // Check if exam exists
        if (!$exam) {
            return response()->json([
                'success' => false,
                'message' => 'Exam not found.',
            ], 404);
        }

        // Apply visibility rules
        $user = auth('sanctum')->user();
        if ($exam->visibility === 'private') {
            if (!$user || $user->school_id !== $exam->school_id) {
                return response()->json(['success' => false, 'message' => 'This exam is private.'], 403);
            }
        } elseif ($exam->visibility === 'followers') {
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'This exam is restricted to followers.'], 403);
            }
            $schoolIds = $user->schools()->pluck('schools.id')->toArray();
            if ($user->school_id) $schoolIds[] = $user->school_id;
            
            if (!in_array($exam->school_id, $schoolIds)) {
                return response()->json(['success' => false, 'message' => 'This exam is restricted to followers of the school.'], 403);
            }
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
        $query = Exam::with(['school', 'subject'])->where('is_featured', true);
        
        $user = auth('sanctum')->user();
        $query->where(function($q) use ($user) {
            $q->where('visibility', 'public')->orWhereNull('visibility');
            if ($user) {
                $q->orWhere(function($q2) use ($user) {
                    $q2->where('visibility', 'private')->where('school_id', $user->school_id);
                });
                $schoolIds = $user->schools()->pluck('schools.id')->toArray();
                if ($user->school_id) $schoolIds[] = $user->school_id;
                if (!empty($schoolIds)) {
                    $q->orWhere(function($q3) use ($schoolIds) {
                        $q3->where('visibility', 'followers')->whereIn('school_id', $schoolIds);
                    });
                }
            }
        });

        $exams = $query->get();

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
        $query = Exam::with(['school', 'subject']);
        $query->where('status', 1); // Only show exams that are active
        $query->whereHas('questions');

        // Apply visibility rules
        $user = auth('sanctum')->user();
        $query->where(function($q) use ($user) {
            $q->where('visibility', 'public')->orWhereNull('visibility');
            if ($user) {
                $q->orWhere(function($q2) use ($user) {
                    $q2->where('visibility', 'private')->where('school_id', $user->school_id);
                });
                $schoolIds = $user->schools()->pluck('schools.id')->toArray();
                if ($user->school_id) $schoolIds[] = $user->school_id;
                if (!empty($schoolIds)) {
                    $q->orWhere(function($q3) use ($schoolIds) {
                        $q3->where('visibility', 'followers')->whereIn('school_id', $schoolIds);
                    });
                }
            }
        });

        $exams = $query->orderBy('popularity', 'desc')->limit(10)->get();

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
        $query = Exam::with(['school', 'subject']);
        $query->where('status', 1);
        $query->whereHas('questions');

        // Apply visibility rules
        $user = auth('sanctum')->user();
        $query->where(function($q) use ($user) {
            $q->where('visibility', 'public')->orWhereNull('visibility');
            if ($user) {
                $q->orWhere(function($q2) use ($user) {
                    $q2->where('visibility', 'private')->where('school_id', $user->school_id);
                });
                $schoolIds = $user->schools()->pluck('schools.id')->toArray();
                if ($user->school_id) $schoolIds[] = $user->school_id;
                if (!empty($schoolIds)) {
                    $q->orWhere(function($q3) use ($schoolIds) {
                        $q3->where('visibility', 'followers')->whereIn('school_id', $schoolIds);
                    });
                }
            }
        });

        $recommendedExams =  $query->where('recommended', true)->get();

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
