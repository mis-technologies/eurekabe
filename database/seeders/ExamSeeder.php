<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\Models\Exam;
use Modules\Common\Models\File;
use Modules\Common\Models\Question;
use Modules\Common\Models\QuestionOption;
use Modules\Common\Models\School;
use Modules\Common\Models\Subject;

class ExamSeeder extends Seeder
{
    public function run(): void
    {
        // ── Data ────────────────────────────────────────────────────────
        // Each entry: exam metadata + questions array.
        // question_type_id: 1 = MCQ
        $data = [

            // ── Mathematics (JAMB level) ────────────────────────────────
            [
                'exam' => [
                    'title'           => 'JAMB Mathematics Practice — Paper 1',
                    'subject'         => 'Mathematics',
                    'school'          => 'UNILAG',
                    'duration'        => 60,
                    'pass_percentage' => 50,
                    'instruction'     => 'Choose the most correct option for each question. Each question carries 1 mark.',
                    'status'          => 1,
                    'image'           => 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=800&h=400&fit=crop&q=80',
                ],
                'questions' => [
                    [
                        'question' => 'Simplify: (2³ × 2⁴) ÷ 2⁵',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '4',  'is_correct' => true],
                            ['option' => '8',  'is_correct' => false],
                            ['option' => '16', 'is_correct' => false],
                            ['option' => '2',  'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Find the value of x if 3x + 5 = 20.',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '5',  'is_correct' => true],
                            ['option' => '4',  'is_correct' => false],
                            ['option' => '6',  'is_correct' => false],
                            ['option' => '3',  'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'What is the sum of interior angles of a hexagon?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '720°',  'is_correct' => true],
                            ['option' => '540°',  'is_correct' => false],
                            ['option' => '900°',  'is_correct' => false],
                            ['option' => '360°',  'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'If log₁₀ 2 = 0.3010, find log₁₀ 8.',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '0.9030', 'is_correct' => true],
                            ['option' => '0.6020', 'is_correct' => false],
                            ['option' => '1.2040', 'is_correct' => false],
                            ['option' => '0.8010', 'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'A car travels 120 km in 2 hours. What is its average speed?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '60 km/h',  'is_correct' => true],
                            ['option' => '80 km/h',  'is_correct' => false],
                            ['option' => '50 km/h',  'is_correct' => false],
                            ['option' => '100 km/h', 'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Factorize: x² - 9',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '(x+3)(x-3)',  'is_correct' => true],
                            ['option' => '(x-3)²',      'is_correct' => false],
                            ['option' => '(x+3)²',      'is_correct' => false],
                            ['option' => '(x-9)(x+1)',  'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'What is the probability of getting a head when a fair coin is tossed?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '1/2', 'is_correct' => true],
                            ['option' => '1/4', 'is_correct' => false],
                            ['option' => '2/3', 'is_correct' => false],
                            ['option' => '1',   'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Express 0.000472 in standard form.',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '4.72 × 10⁻⁴', 'is_correct' => true],
                            ['option' => '4.72 × 10⁴',  'is_correct' => false],
                            ['option' => '47.2 × 10⁻³', 'is_correct' => false],
                            ['option' => '0.472 × 10⁻³','is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Find the gradient of the line y = 3x - 7.',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '3',  'is_correct' => true],
                            ['option' => '-7', 'is_correct' => false],
                            ['option' => '7',  'is_correct' => false],
                            ['option' => '-3', 'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'A rectangle has length 8 cm and width 5 cm. What is its area?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '40 cm²', 'is_correct' => true],
                            ['option' => '26 cm²', 'is_correct' => false],
                            ['option' => '13 cm²', 'is_correct' => false],
                            ['option' => '80 cm²', 'is_correct' => false],
                        ],
                    ],
                ],
            ],

            // ── English Language ─────────────────────────────────────────
            [
                'exam' => [
                    'title'           => 'JAMB Use of English — Paper 1',
                    'subject'         => 'Use of English',
                    'school'          => 'UI',
                    'duration'        => 60,
                    'pass_percentage' => 50,
                    'instruction'     => 'Read each question carefully and select the best answer.',
                    'status'          => 1,
                    'image'           => 'https://images.unsplash.com/photo-1457369804613-52c61a468e7d?w=800&h=400&fit=crop&q=80',
                ],
                'questions' => [
                    [
                        'question' => 'Choose the option that correctly fills the gap: She ___ to school every day.',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'goes',   'is_correct' => true],
                            ['option' => 'go',     'is_correct' => false],
                            ['option' => 'gone',   'is_correct' => false],
                            ['option' => 'going',  'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which of the following is a synonym for "benevolent"?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Kind',       'is_correct' => true],
                            ['option' => 'Cruel',      'is_correct' => false],
                            ['option' => 'Indifferent','is_correct' => false],
                            ['option' => 'Arrogant',   'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'The plural of "mouse" is:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'mice',   'is_correct' => true],
                            ['option' => 'mouses', 'is_correct' => false],
                            ['option' => 'mouse',  'is_correct' => false],
                            ['option' => 'mices',  'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Select the correctly punctuated sentence:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => "Its a beautiful day, isn't it?",    'is_correct' => false],
                            ['option' => "It's a beautiful day, isn't it?",   'is_correct' => true],
                            ['option' => "Its a beautiful day isnt it?",      'is_correct' => false],
                            ['option' => "It's a beautiful day isnt it?",     'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'The word "euphemism" means:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'A mild expression for something unpleasant', 'is_correct' => true],
                            ['option' => 'An exaggerated statement',                   'is_correct' => false],
                            ['option' => 'A figure of speech comparing two things',    'is_correct' => false],
                            ['option' => 'Repetition of the same sound',               'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Identify the adverb in: "He ran quickly to the bus stop."',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'quickly', 'is_correct' => true],
                            ['option' => 'ran',     'is_correct' => false],
                            ['option' => 'bus',     'is_correct' => false],
                            ['option' => 'stop',    'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which sentence is in the passive voice?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'The cat chased the mouse.',        'is_correct' => false],
                            ['option' => 'The mouse was chased by the cat.', 'is_correct' => true],
                            ['option' => 'She sang a song.',                 'is_correct' => false],
                            ['option' => 'They played football.',            'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'The antonym of "verbose" is:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Concise',   'is_correct' => true],
                            ['option' => 'Wordy',     'is_correct' => false],
                            ['option' => 'Talkative', 'is_correct' => false],
                            ['option' => 'Lengthy',   'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Choose the correct form: "Neither the boys nor the girl ___ present."',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'was',  'is_correct' => true],
                            ['option' => 'were', 'is_correct' => false],
                            ['option' => 'are',  'is_correct' => false],
                            ['option' => 'is',   'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which literary device is used in "The stars danced in the night sky"?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Personification', 'is_correct' => true],
                            ['option' => 'Simile',          'is_correct' => false],
                            ['option' => 'Hyperbole',       'is_correct' => false],
                            ['option' => 'Alliteration',    'is_correct' => false],
                        ],
                    ],
                ],
            ],

            // ── Physics ──────────────────────────────────────────────────
            [
                'exam' => [
                    'title'           => 'WAEC Physics — Paper 1',
                    'subject'         => 'Physics',
                    'school'          => 'OAU',
                    'duration'        => 60,
                    'pass_percentage' => 50,
                    'instruction'     => 'Each question carries 1 mark. Negative marking does not apply.',
                    'status'          => 1,
                    'image'           => 'https://images.unsplash.com/photo-1636466497217-26a8cbeaf0aa?w=800&h=400&fit=crop&q=80',
                ],
                'questions' => [
                    [
                        'question' => 'What is the SI unit of force?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Newton',  'is_correct' => true],
                            ['option' => 'Joule',   'is_correct' => false],
                            ['option' => 'Pascal',  'is_correct' => false],
                            ['option' => 'Watt',    'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which of the following is a scalar quantity?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Speed',        'is_correct' => true],
                            ['option' => 'Velocity',     'is_correct' => false],
                            ['option' => 'Acceleration', 'is_correct' => false],
                            ['option' => 'Force',        'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'The acceleration due to gravity on Earth is approximately:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '9.8 m/s²', 'is_correct' => true],
                            ['option' => '6.4 m/s²', 'is_correct' => false],
                            ['option' => '3.2 m/s²', 'is_correct' => false],
                            ['option' => '12 m/s²',  'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Ohm\'s law states that current is:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Directly proportional to voltage at constant resistance',    'is_correct' => true],
                            ['option' => 'Inversely proportional to voltage at constant resistance',   'is_correct' => false],
                            ['option' => 'Independent of voltage',                                     'is_correct' => false],
                            ['option' => 'Equal to resistance times power',                            'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'What type of wave is sound?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Longitudinal wave',    'is_correct' => true],
                            ['option' => 'Transverse wave',      'is_correct' => false],
                            ['option' => 'Electromagnetic wave', 'is_correct' => false],
                            ['option' => 'Standing wave',        'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'The process by which a liquid turns to gas at its surface is called:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Evaporation', 'is_correct' => true],
                            ['option' => 'Condensation','is_correct' => false],
                            ['option' => 'Sublimation', 'is_correct' => false],
                            ['option' => 'Melting',     'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which colour of light has the highest frequency?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Violet', 'is_correct' => true],
                            ['option' => 'Red',    'is_correct' => false],
                            ['option' => 'Green',  'is_correct' => false],
                            ['option' => 'Yellow', 'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'A machine has an efficiency of 80%. If the effort applied is 100 N, what is the output force for a load of 60 N?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '80 N',  'is_correct' => true],
                            ['option' => '100 N', 'is_correct' => false],
                            ['option' => '60 N',  'is_correct' => false],
                            ['option' => '48 N',  'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'The kinetic energy of an object depends on its:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Mass and velocity', 'is_correct' => true],
                            ['option' => 'Height only',       'is_correct' => false],
                            ['option' => 'Volume only',       'is_correct' => false],
                            ['option' => 'Density and height','is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which law of motion explains why a passenger lurches forward when a bus stops suddenly?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Newton\'s First Law',  'is_correct' => true],
                            ['option' => 'Newton\'s Second Law', 'is_correct' => false],
                            ['option' => 'Newton\'s Third Law',  'is_correct' => false],
                            ['option' => 'Hooke\'s Law',         'is_correct' => false],
                        ],
                    ],
                ],
            ],

            // ── Chemistry ────────────────────────────────────────────────
            [
                'exam' => [
                    'title'           => 'WAEC Chemistry — Paper 1',
                    'subject'         => 'Chemistry',
                    'school'          => 'ABU',
                    'duration'        => 60,
                    'pass_percentage' => 50,
                    'instruction'     => 'Select the most appropriate answer for each question.',
                    'status'          => 1,
                    'image'           => 'https://images.unsplash.com/photo-1532187863486-abf9dbad1b69?w=800&h=400&fit=crop&q=80',
                ],
                'questions' => [
                    [
                        'question' => 'What is the atomic number of Carbon?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '6',  'is_correct' => true],
                            ['option' => '12', 'is_correct' => false],
                            ['option' => '8',  'is_correct' => false],
                            ['option' => '14', 'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which gas is produced when zinc reacts with dilute hydrochloric acid?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Hydrogen',       'is_correct' => true],
                            ['option' => 'Oxygen',         'is_correct' => false],
                            ['option' => 'Chlorine',       'is_correct' => false],
                            ['option' => 'Carbon dioxide', 'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'The pH of a neutral solution at 25°C is:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '7',  'is_correct' => true],
                            ['option' => '0',  'is_correct' => false],
                            ['option' => '14', 'is_correct' => false],
                            ['option' => '5',  'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which of the following is an example of an exothermic reaction?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Combustion of wood',     'is_correct' => true],
                            ['option' => 'Photosynthesis',         'is_correct' => false],
                            ['option' => 'Dissolving ammonium nitrate', 'is_correct' => false],
                            ['option' => 'Thermal decomposition',  'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'What is the chemical formula for water?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'H₂O',  'is_correct' => true],
                            ['option' => 'HO₂',  'is_correct' => false],
                            ['option' => 'H₂O₂', 'is_correct' => false],
                            ['option' => 'OH',   'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which element is the most abundant in the Earth\'s crust?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Oxygen',    'is_correct' => true],
                            ['option' => 'Silicon',   'is_correct' => false],
                            ['option' => 'Aluminium', 'is_correct' => false],
                            ['option' => 'Iron',      'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'A compound that turns moist red litmus paper blue is:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Ammonia',          'is_correct' => true],
                            ['option' => 'Hydrochloric acid','is_correct' => false],
                            ['option' => 'Carbon dioxide',   'is_correct' => false],
                            ['option' => 'Sulphur dioxide',  'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'The process of separating a soluble solid from its solution by cooling is called:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Crystallisation', 'is_correct' => true],
                            ['option' => 'Distillation',    'is_correct' => false],
                            ['option' => 'Filtration',      'is_correct' => false],
                            ['option' => 'Evaporation',     'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Isotopes are atoms of the same element with different:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Number of neutrons',  'is_correct' => true],
                            ['option' => 'Number of protons',   'is_correct' => false],
                            ['option' => 'Number of electrons', 'is_correct' => false],
                            ['option' => 'Atomic number',       'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'The molar mass of NaCl (Na=23, Cl=35.5) is:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '58.5 g/mol', 'is_correct' => true],
                            ['option' => '45 g/mol',   'is_correct' => false],
                            ['option' => '68 g/mol',   'is_correct' => false],
                            ['option' => '53 g/mol',   'is_correct' => false],
                        ],
                    ],
                ],
            ],

            // ── Economics ────────────────────────────────────────────────
            [
                'exam' => [
                    'title'           => 'JAMB Economics — Paper 1',
                    'subject'         => 'Economics',
                    'school'          => 'UNIBEN',
                    'duration'        => 60,
                    'pass_percentage' => 50,
                    'instruction'     => 'Answer all questions. Each question carries 1 mark.',
                    'status'          => 1,
                    'image'           => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=800&h=400&fit=crop&q=80',
                ],
                'questions' => [
                    [
                        'question' => 'Economics is best defined as:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'The study of how scarce resources are allocated among competing wants', 'is_correct' => true],
                            ['option' => 'The study of money and banking',           'is_correct' => false],
                            ['option' => 'The study of trade between countries',     'is_correct' => false],
                            ['option' => 'The study of government spending',         'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'The law of demand states that, all things being equal, as price increases:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Quantity demanded decreases', 'is_correct' => true],
                            ['option' => 'Quantity demanded increases', 'is_correct' => false],
                            ['option' => 'Supply increases',            'is_correct' => false],
                            ['option' => 'Supply decreases',            'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which of the following is a factor of production?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Land',   'is_correct' => true],
                            ['option' => 'Profit', 'is_correct' => false],
                            ['option' => 'Rent',   'is_correct' => false],
                            ['option' => 'Tax',    'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'GDP stands for:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Gross Domestic Product',    'is_correct' => true],
                            ['option' => 'General Domestic Price',    'is_correct' => false],
                            ['option' => 'Gross Domestic Price',      'is_correct' => false],
                            ['option' => 'General Development Product','is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Inflation is defined as:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'A sustained rise in the general price level', 'is_correct' => true],
                            ['option' => 'A fall in the general price level',           'is_correct' => false],
                            ['option' => 'An increase in unemployment',                 'is_correct' => false],
                            ['option' => 'A rise in interest rates',                    'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which market structure has a single seller?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Monopoly',          'is_correct' => true],
                            ['option' => 'Oligopoly',         'is_correct' => false],
                            ['option' => 'Perfect competition','is_correct' => false],
                            ['option' => 'Duopoly',           'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'The central bank of Nigeria is:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'CBN',     'is_correct' => true],
                            ['option' => 'GTBank',  'is_correct' => false],
                            ['option' => 'UBA',     'is_correct' => false],
                            ['option' => 'NEXIM',   'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Opportunity cost is best described as:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'The next best alternative forgone',      'is_correct' => true],
                            ['option' => 'The cost of producing a good',           'is_correct' => false],
                            ['option' => 'The profit earned from a decision',      'is_correct' => false],
                            ['option' => 'The total cost of all goods purchased',  'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which of the following is a characteristic of a free market economy?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Private ownership of resources',    'is_correct' => true],
                            ['option' => 'Government control of all prices',  'is_correct' => false],
                            ['option' => 'Central planning of production',    'is_correct' => false],
                            ['option' => 'Equal distribution of wealth',      'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Elasticity of demand measures:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Responsiveness of quantity demanded to a change in price', 'is_correct' => true],
                            ['option' => 'Responsiveness of supply to a change in demand',          'is_correct' => false],
                            ['option' => 'Responsiveness of price to a change in supply',           'is_correct' => false],
                            ['option' => 'Responsiveness of income to a change in employment',      'is_correct' => false],
                        ],
                    ],
                ],
            ],

            // ── Computer Science ─────────────────────────────────────────
            [
                'exam' => [
                    'title'           => 'Post-UTME Computer Science — Practice Test',
                    'subject'         => 'Computer Science',
                    'school'          => 'UNILAG',
                    'duration'        => 45,
                    'pass_percentage' => 50,
                    'instruction'     => 'Answer all 10 questions. Each question is worth 1 mark.',
                    'status'          => 1,
                    'image'           => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&h=400&fit=crop&q=80',
                ],
                'questions' => [
                    [
                        'question' => 'What does CPU stand for?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Central Processing Unit',     'is_correct' => true],
                            ['option' => 'Core Processing Unit',        'is_correct' => false],
                            ['option' => 'Central Program Unit',        'is_correct' => false],
                            ['option' => 'Computer Processing Unit',    'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which of the following is an example of secondary storage?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Hard disk drive',  'is_correct' => true],
                            ['option' => 'RAM',              'is_correct' => false],
                            ['option' => 'CPU cache',        'is_correct' => false],
                            ['option' => 'ROM',              'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'The binary equivalent of decimal 10 is:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => '1010', 'is_correct' => true],
                            ['option' => '1001', 'is_correct' => false],
                            ['option' => '1100', 'is_correct' => false],
                            ['option' => '0110', 'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which language is considered closest to machine language?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Assembly language', 'is_correct' => true],
                            ['option' => 'Python',            'is_correct' => false],
                            ['option' => 'Java',              'is_correct' => false],
                            ['option' => 'HTML',              'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'An algorithm is:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'A step-by-step procedure to solve a problem',  'is_correct' => true],
                            ['option' => 'A programming language',                       'is_correct' => false],
                            ['option' => 'A type of computer hardware',                  'is_correct' => false],
                            ['option' => 'A computer virus',                             'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which protocol is used to send emails?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'SMTP',  'is_correct' => true],
                            ['option' => 'HTTP',  'is_correct' => false],
                            ['option' => 'FTP',   'is_correct' => false],
                            ['option' => 'HTTPS', 'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'What is the full meaning of WWW?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'World Wide Web',       'is_correct' => true],
                            ['option' => 'World Web Wireless',   'is_correct' => false],
                            ['option' => 'Worldwide Website',    'is_correct' => false],
                            ['option' => 'Web Wide World',       'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which of the following is NOT an operating system?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Microsoft Word', 'is_correct' => true],
                            ['option' => 'Windows 11',     'is_correct' => false],
                            ['option' => 'macOS',          'is_correct' => false],
                            ['option' => 'Ubuntu',         'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'What does "URL" stand for?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Uniform Resource Locator',   'is_correct' => true],
                            ['option' => 'Universal Resource Locator', 'is_correct' => false],
                            ['option' => 'Uniform Resource Link',      'is_correct' => false],
                            ['option' => 'Universal Reference Link',   'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which data structure operates on a Last-In-First-Out (LIFO) principle?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Stack', 'is_correct' => true],
                            ['option' => 'Queue', 'is_correct' => false],
                            ['option' => 'Tree',  'is_correct' => false],
                            ['option' => 'Graph', 'is_correct' => false],
                        ],
                    ],
                ],
            ],

            // ── Biology ──────────────────────────────────────────────────
            [
                'exam' => [
                    'title'           => 'WAEC Biology — Paper 1',
                    'subject'         => 'Biology',
                    'school'          => 'UNN',
                    'duration'        => 60,
                    'pass_percentage' => 50,
                    'instruction'     => 'Choose the best option. All questions carry equal marks.',
                    'status'          => 1,
                    'image'           => 'https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=800&h=400&fit=crop&q=80',
                ],
                'questions' => [
                    [
                        'question' => 'The basic unit of life is:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Cell',     'is_correct' => true],
                            ['option' => 'Tissue',   'is_correct' => false],
                            ['option' => 'Organ',    'is_correct' => false],
                            ['option' => 'Organism', 'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Photosynthesis takes place in the:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Chloroplast',   'is_correct' => true],
                            ['option' => 'Mitochondria',  'is_correct' => false],
                            ['option' => 'Ribosome',      'is_correct' => false],
                            ['option' => 'Nucleus',       'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'DNA is found mainly in the:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Nucleus',      'is_correct' => true],
                            ['option' => 'Cytoplasm',    'is_correct' => false],
                            ['option' => 'Cell membrane','is_correct' => false],
                            ['option' => 'Vacuole',      'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which of the following is a mammal?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Whale',    'is_correct' => true],
                            ['option' => 'Crocodile','is_correct' => false],
                            ['option' => 'Frog',     'is_correct' => false],
                            ['option' => 'Tilapia',  'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Osmosis is the movement of water from a region of:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Lower solute concentration to higher solute concentration through a semi-permeable membrane', 'is_correct' => true],
                            ['option' => 'Higher concentration to lower concentration',  'is_correct' => false],
                            ['option' => 'Higher pressure to lower pressure',            'is_correct' => false],
                            ['option' => 'Lower temperature to higher temperature',      'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which blood group is the universal donor?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'O',  'is_correct' => true],
                            ['option' => 'A',  'is_correct' => false],
                            ['option' => 'B',  'is_correct' => false],
                            ['option' => 'AB', 'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'The powerhouse of the cell is the:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Mitochondrion', 'is_correct' => true],
                            ['option' => 'Chloroplast',   'is_correct' => false],
                            ['option' => 'Ribosome',      'is_correct' => false],
                            ['option' => 'Golgi body',    'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which vitamin is produced by the skin on exposure to sunlight?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Vitamin D', 'is_correct' => true],
                            ['option' => 'Vitamin A', 'is_correct' => false],
                            ['option' => 'Vitamin C', 'is_correct' => false],
                            ['option' => 'Vitamin B', 'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'Which organ is responsible for producing insulin?',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Pancreas', 'is_correct' => true],
                            ['option' => 'Liver',    'is_correct' => false],
                            ['option' => 'Kidney',   'is_correct' => false],
                            ['option' => 'Spleen',   'is_correct' => false],
                        ],
                    ],
                    [
                        'question' => 'The process by which organisms produce offspring is called:',
                        'marks'    => 1,
                        'options'  => [
                            ['option' => 'Reproduction', 'is_correct' => true],
                            ['option' => 'Respiration',  'is_correct' => false],
                            ['option' => 'Excretion',    'is_correct' => false],
                            ['option' => 'Nutrition',    'is_correct' => false],
                        ],
                    ],
                ],
            ],

        ];

        // ── Seed ────────────────────────────────────────────────────────
        $examCount = 0;
        $questionCount = 0;

        foreach ($data as $entry) {
            $examData    = $entry['exam'];
            $questionsData = $entry['questions'];

            // Resolve school and subject
            $school  = School::where('acronym', $examData['school'])->first();
            $subject = Subject::where('name', $examData['subject'])->first();

            if (! $school || ! $subject) {
                $this->command->warn("Skipping \"{$examData['title']}\" — school or subject not found.");
                continue;
            }

            // Find or create the exam
            $exam = Exam::where('title', $examData['title'])
                        ->where('school_id', $school->id)
                        ->first();

            if ($exam) {
                // Exam exists — just upsert the image file record
                $this->upsertExamImage($exam, $examData['image'] ?? null);
                $this->command->line("  Updated image: {$exam->title}");
                continue;
            }

            $exam = Exam::create([
                'title'           => $examData['title'],
                'subject_id'      => $subject->id,
                'school_id'       => $school->id,
                'duration'        => $examData['duration'],
                'pass_percentage' => $examData['pass_percentage'],
                'instruction'     => $examData['instruction'],
                'status'          => $examData['status'],
                'question_type'   => 1, // MCQ
                'start_date'      => now()->toDateString(),
                'end_date'        => now()->addYear()->toDateString(),
            ]);

            // Attach image via File record (same mechanism the app uses)
            $this->upsertExamImage($exam, $examData['image'] ?? null);

            $examCount++;

            foreach ($questionsData as $qData) {
                $question = Question::create([
                    'exam_id'          => $exam->id,
                    'question'         => $qData['question'],
                    'marks'            => $qData['marks'],
                    'question_type_id' => 1, // MCQ
                    'status'           => 1,
                ]);

                foreach ($qData['options'] as $opt) {
                    QuestionOption::create([
                        'question_id' => $question->id,
                        'option'      => $opt['option'],
                        'is_correct'  => $opt['is_correct'] ? 1 : 0,
                    ]);
                }

                $questionCount++;
            }

            $this->command->line("  Created: {$exam->title} ({$questionCount} questions so far)");
        }

        $this->command->info("Exams seeded: {$examCount} exams, {$questionCount} questions.");
    }

    private function upsertExamImage(Exam $exam, ?string $imageUrl): void
    {
        if (! $imageUrl) return;

        File::updateOrCreate(
            [
                'entity'     => get_class($exam),   // 'Modules\Common\Models\Exam'
                'entity_id'  => $exam->id,
                'identifier' => 'image',
            ],
            [
                'user_id'   => 1,
                'disk'      => 'cloudinary',        // path returned as-is by File::getUrlAttribute()
                'path'      => $imageUrl,
                'filename'  => 'exam-cover.jpg',
                'extension' => 'jpg',
                'mime'      => 'image/jpeg',
            ]
        );
    }
}
