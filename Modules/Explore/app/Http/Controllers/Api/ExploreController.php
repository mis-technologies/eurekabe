<?php

namespace Modules\Explore\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Modules\Common\Models\School;
use Illuminate\Http\Request;
use Modules\Exam\Models\Exam;
use Modules\Exam\Models\Subject;

class ExploreController extends Controller
{
 

     /**
     * Retrieve 10 items for all groupings: "recommend", "featured", and "popular".
     */
    public function index()
    {
        // Retrieve 10 featured exams
        $featuredExams =Exam::inRandomOrder()->limit(5)->get();//Exam::where('is_featured', true)->limit(10)->get();

        // Retrieve 10 popular exams based on a popularity metric (e.g., number of views or enrollments)
        $popularExams = Exam::inRandomOrder()->limit(5)->get();//Exam::orderBy('popularity', 'desc')->limit(10)->get();

        // Retrieve 10 recommended exams based on some criteria (e.g., user preferences)
        $recommendedExams = Exam::inRandomOrder()->limit(5)->get(); //Exam::where('recommended', true)->limit(10)->get();

        $categories = Subject::inRandomOrder()->limit(20)->get();

        $students = User::where('role', 'student')->inRandomOrder()->limit(20)->get();


        // Return all groupings in a single response
        return response()->json([
            'success' => true,
            'data' => [
                'featured' => $featuredExams,
                'popular' => $popularExams,
                'recommended' => $recommendedExams,
                'categories' => $categories,
                'students' => $students,
            ],
        ], 200);
    }

   
}
