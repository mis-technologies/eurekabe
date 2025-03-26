<?php
namespace Modules\Exam\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Common\Actions\OpenRouter;
use Modules\Exam\Models\Exam;
use Modules\Exam\Models\Question;
use Modules\Exam\Models\QuestionOption;

class AIExamController extends Controller
{
    public function generateQuestions(Request $request)
    {
        // Get request parameters with defaults
        $totalQuestions = $request->input('total_questions', 50);
        $batchSize = $request->input('batch_size', 10);
        $topic = $request->input('topic', "Basic Mechanics within Physics, focusing on Newton's Laws of Motion");

        // Ensure valid input values
        if ($totalQuestions < 1 || $batchSize < 1) {
            return response()->json([
                'success' => false,
                'error' => 'Invalid total_questions or batch_size values',
            ], 400);
        }

        $allQuestions = [];

        try {
            // Fetch questions in batches
            for ($i = 0; $i < ceil($totalQuestions / $batchSize); $i++) {
                $batchQuestions = $this->fetchBatch($batchSize, $topic);

                if ($batchQuestions) {
                    $allQuestions = array_merge($allQuestions, $batchQuestions);
                }

                // Intercept and max execution time here and increase it
                ini_set('max_execution_time', 300000);

                // Prevent exceeding API limits
                usleep(0); // 0.5 second delay between requests
            }

            return response()->json([
                'success' => true,
                'data' => array_slice($allQuestions, 0, $totalQuestions), // Trim excess questions
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to generate questions: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function fetchBatch($batchSize, $topic)
    {
        $res = OpenRouter::chat([
            [
                "role" => "user",
                "content" => sprintf(
                    "Please generate multiple-choice exam questions following these requirements:
                    1. Create %d questions with 4 answer options each
                    2. Each question should:
                    - Be clear and unambiguous
                    - Test a specific concept or knowledge point
                    - Have only one correct answer
                    - Include plausible but incorrect distractors
                    - Return a JSON, do not add any pretext and do not use any new line characters

                    Format each question exactly as shown in this JSON structure:
                    [
                        {
                            \"question\": \"Question text here\",
                            \"marks\": 1.0,
                            \"options\": [
                                { \"option\": \"Option text\", \"is_correct\": false },
                                { \"option\": \"Option text\", \"is_correct\": true }
                            ]
                        }
                    ]
                    Topic: %s", $batchSize, $topic
                ),
            ],
        ], 'mistralai/ministral-8b');

        // Validate response structure
        if (!isset($res['choices'][0]['message']['content'])) {
            throw new Exception('Invalid response from OpenRouter');
        }

        return $this->processResponse($res['choices'][0]['message']['content']);
    }

    private function processResponse($response)
    {
        $decoded = OpenRouter::processResponse($response);

        // Add status field and reformat
        return array_map(fn($question) => array_merge($question, ['status' => 0]), $decoded);
    }

    public function saveGeneratedExam(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'instruction' => 'required|string',
            'duration' => 'required|integer|min:1',
            'pass_percentage' => 'required|integer|min:0|max:100',
            'status' => 'required|integer|in:1,2', // Assuming 1 = Active, 2 = Inactive
            'school_id' => 'required|exists:schools,id',
            'subject_id' => 'required|exists:subjects,id',
            'questions' => 'required|array',
            'questions.*.question' => 'required|string',
            'questions.*.marks' => 'required|numeric|min:1',
            'questions.*.options' => 'required|array|min:2', // Ensure at least 2 options
            'questions.*.options.*.option' => 'required|string',
            'questions.*.options.*.is_correct' => 'required|boolean',
        ]);

        // $validated = $request->all();

        try {
            DB::beginTransaction();

            // Save Exam
            $exam = new Exam();
            $exam->title = $validated['title'];
            $exam->instruction = $validated['instruction'];
            $exam->duration = $validated['duration'];
            $exam->pass_percentage = $validated['pass_percentage'];
            $exam->status = $validated['status'];
            $exam->subject_id = $validated['subject_id'];
            $exam->totalmark = array_sum(array_column($validated['questions'], 'marks'));
            $exam->value = 0;
            $exam->school_id = $validated['school_id'];
            $exam->save();

            // Save Questions & Options
            foreach ($validated['questions'] as $questionData) {
                $question = new Question();
                $question->exam_id = $exam->id;
                $question->question = $questionData['question'];
                $question->marks = $questionData['marks'];
                $question->save();

                foreach ($questionData['options'] as $optionData) {
                    $option = new QuestionOption();
                    $option->question_id = $question->id;
                    $option->option = $optionData['option'];
                    $option->is_correct = $optionData['is_correct'];
                    $option->save();
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Exam and questions saved successfully!',
                'exam_id' => $exam->id,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to save exam. Error: ' . $e->getMessage(),
            ], 500);
        }
    }

}
