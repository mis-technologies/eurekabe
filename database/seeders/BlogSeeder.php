<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\Category;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('slug');

        $articles = [
            // ── Exam Prep ──────────────────────────────────────────────────────
            [
                'title'       => 'How to Ace WAEC Mathematics in 30 Days',
                'slug'        => 'how-to-ace-waec-mathematics-in-30-days',
                'category'    => 'exam-prep',
                'image'       => 'https://images.unsplash.com/photo-1635070041078-e363dbe005cb?w=800&q=80',
                'content'     => 'With WAEC Mathematics just around the corner, a focused 30-day plan can transform your score. Start by downloading the last five years of past questions and categorising them by topic — Algebra, Mensuration, Statistics, and Trigonometry. Week one should be entirely diagnostic: work through one full past paper daily under timed conditions, marking strictly, then drilling every question you got wrong. In week two, attack your two weakest topics head-on. Algebra is where most marks are lost because students rush the factorisation and simultaneous equation steps. Write out every working line — partial marks save grades. Week three is about speed and accuracy: set a timer for each section and practise switching topics quickly. In your final week, only touch past papers. Read every question twice. Carry a formula sheet on revision days but aim to memorise it by exam day. The night before, sleep early. A rested brain is worth more than another hour of cramming.',
                'status'      => 'PUBLISHED',
            ],
            [
                'title'       => 'NECO vs WAEC: Which Should You Prioritise?',
                'slug'        => 'neco-vs-waec-which-should-you-prioritise',
                'category'    => 'exam-prep',
                'image'       => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&q=80',
                'content'     => 'Every SS3 student faces the same question: should I invest more time in WAEC or NECO? The honest answer depends on your university of choice. Most federal universities and high-demand courses like Medicine and Law give equal weight to both, but admissions officers have shared off-the-record that WAEC is the de-facto standard — partly because it has a longer reputation and partly because international institutions recognise it more readily. That said, NECO is held later in the year, giving you extra preparation weeks if WAEC does not go to plan. The smart strategy is to treat them as one integrated preparation block. The syllabi overlap by roughly 85%. Write your difficult subjects in both sittings to maximise your chances of the A or B that medicine or engineering demands. Do not neglect NECO just because WAEC comes first — institutions like UNILAG and UI have accepted students on NECO results alone.',
                'status'      => 'PUBLISHED',
            ],
            [
                'title'       => 'Top 6 JAMB Essay-Writing Mistakes to Avoid',
                'slug'        => 'top-6-jamb-essay-writing-mistakes-to-avoid',
                'category'    => 'exam-prep',
                'image'       => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?w=800&q=80',
                'content'     => 'The Use of English paper trips more UTME candidates than any other subject. Here are the six most common blunders. First: ignoring the instruction word. "Discuss" and "explain" are not the same thing. Read the prompt three times before you write a single word. Second: writing a single unbroken paragraph. Examiners grade structure. An introduction, three developed body paragraphs, and a tight conclusion can add five to eight marks. Third: repeating the question in the introduction. Start with a bold claim or a striking fact instead. Fourth: vague vocabulary. Swap "bad things happen" for "adverse consequences compound". Precision signals maturity. Fifth: ignoring counter-arguments in argumentative essays. Acknowledge the opposing view in one paragraph and rebut it — this is what separates an A from a B. Sixth: poor time allocation. You have roughly 30 minutes for the essay. Outline for five, write for 20, and proofread for five. Never skip the proofread.',
                'status'      => 'PUBLISHED',
            ],

            // ── Study Tips ────────────────────────────────────────────────────
            [
                'title'       => 'The Science of Active Recall: Study Smarter, Not Harder',
                'slug'        => 'the-science-of-active-recall-study-smarter',
                'category'    => 'study-tips',
                'image'       => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&q=80',
                'content'     => 'Passive re-reading is comfortable. It also barely works. Cognitive psychologist Henry Roediger III spent decades proving that testing yourself on material — rather than re-reading it — produces dramatically stronger long-term retention. This is called the testing effect or active recall. Here is how to apply it immediately. After reading a textbook section, close the book and write down everything you can remember. Do not look back until you are stuck. Then check. Every gap is a signal, not a failure — it tells you exactly what to study next. Flashcards work by the same principle: the act of trying to retrieve an answer strengthens the neural pathway. Apps like Anki use spaced repetition algorithms to show you a card just before you are about to forget it — maximising efficiency. For subjects like Biology or History with large content volumes, summarise each chapter in your own words immediately after reading. That single habit can double your recall rate by exam day.',
                'status'      => 'PUBLISHED',
            ],
            [
                'title'       => '10 Time-Management Strategies for SSCE Students',
                'slug'        => '10-time-management-strategies-for-ssce-students',
                'category'    => 'study-tips',
                'image'       => 'https://images.unsplash.com/photo-1506784365847-bbad939e9335?w=800&q=80',
                'content'     => 'Time is the one resource that never replenishes. For students juggling eight SSCE subjects, mismanaging it is the single largest predictor of poor results. Strategy one: plan the week on Sunday night. Assign each subject a slot based on difficulty and your exam schedule, not how much you enjoy it. Strategy two: use the Pomodoro technique — 25 minutes of focused study, five-minute break, repeat. After four cycles, take a 20-minute break. Strategy three: batch similar tasks. Read three subjects back-to-back rather than switching between reading and past-questions every hour. Strategy four: identify your peak hours. Most teenagers focus best between 8am and noon. Guard that window fiercely. Strategy five: say no to social media during study slots — even five-minute phone checks fragment deep concentration. Strategies six through ten cover note organisation, weekly review sessions, study groups for accountability, prioritising hard topics first each day, and getting seven to eight hours of sleep non-negotiably.',
                'status'      => 'PUBLISHED',
            ],
            [
                'title'       => 'How Peer Learning Boosts Academic Performance',
                'slug'        => 'how-peer-learning-boosts-academic-performance',
                'category'    => 'study-tips',
                'image'       => 'https://images.unsplash.com/photo-1529390079861-591de354faf5?w=800&q=80',
                'content'     => 'There is a well-documented phenomenon in education research: students who teach concepts to their peers retain those concepts significantly better than students who only study alone. This is called the protégé effect. When you explain the water cycle to a classmate, your brain is forced to identify and close gaps in your own understanding that passive reading would have left hidden. Study groups work best when each member prepares independently before the session, a topic is assigned to each person to "teach", and the group challenges explanations with questions. The worst study groups are those where everyone opens a textbook and reads quietly in the same room — that is just solo studying with noise. Structure your group: one topic per session, rotate the teacher role, end with a five-question quiz. Research from Cambridge University found that structured peer learning groups outperformed solo study by an average of 18% on standardised assessments.',
                'status'      => 'PUBLISHED',
            ],

            // ── Science ───────────────────────────────────────────────────────
            [
                'title'       => "Newton's Laws of Motion: A Visual Guide for Students",
                'slug'        => 'newtons-laws-of-motion-visual-guide',
                'category'    => 'science',
                'image'       => 'https://images.unsplash.com/photo-1532094349884-543559c5f56a?w=800&q=80',
                'content'     => "Isaac Newton published his three laws of motion in 1687 and they still underpin every mechanics question on your Physics paper. Law one — inertia — states that an object stays at rest or in uniform motion unless acted upon by a net external force. The classic example: a passenger lurches forward when a bus brakes suddenly because their body wants to continue moving. Law two — F = ma — is the workhorse of calculations. Force equals mass times acceleration. If a 5 kg block accelerates at 3 m/s², the net force is 15 N. Always identify your system, draw a free-body diagram, and sum forces in each direction. Law three — action-reaction — states that for every force there is an equal and opposite reaction. A rocket expels gas downward (action); the gas pushes the rocket upward (reaction). Note that action-reaction pairs always act on different objects — they never cancel each other. Sketch these scenarios in your notes and link them to past-question contexts: projectile motion, inclined planes, and Atwood machines are the most common WAEC applications.",
                'status'      => 'PUBLISHED',
            ],
            [
                'title'       => 'Organic Chemistry Made Simple: Functional Groups Explained',
                'slug'        => 'organic-chemistry-functional-groups-explained',
                'category'    => 'science',
                'image'       => 'https://images.unsplash.com/photo-1628595351029-c2bf17511435?w=800&q=80',
                'content'     => 'Organic Chemistry terrifies most Chemistry students — until they realise that the whole subject is built on about twelve functional groups. Master those groups and reactions become predictable patterns, not random facts. Start with alkanes, alkenes, and alkynes. Alkanes (—CH₃) are saturated and undergo substitution reactions. Alkenes (C=C) are unsaturated and undergo addition reactions — bromine water decolourisation is your test. Alkynes add twice. Next, alcohols (—OH): primary alcohols oxidise to aldehydes, then carboxylic acids. Secondary alcohols stop at ketones. Carboxylic acids (—COOH) react with alcohols to form esters — the sweet-smelling products useful in perfumes. Amines (—NH₂) are organic bases. Halogenoalkanes undergo nucleophilic substitution with NaOH. The exam tests whether you can predict products and identify functional groups from molecular formulae. Make a one-page table: functional group, formula, test reagent, observation, and two example reactions. Revisit it every three days until it is automatic.',
                'status'      => 'PUBLISHED',
            ],

            // ── Mathematics ───────────────────────────────────────────────────
            [
                'title'       => 'Mastering Algebra: From Factorisation to Quadratics',
                'slug'        => 'mastering-algebra-factorisation-to-quadratics',
                'category'    => 'mathematics',
                'image'       => 'https://images.unsplash.com/photo-1596495577886-d920f1fb7238?w=800&q=80',
                'content'     => 'Algebra is the gateway to Mathematics success at WAEC, NECO, and JAMB. Students who struggle with it almost always have the same root problem: they skip steps when factorising, creating small errors that cascade into wrong answers. Let us fix that. Factorisation of quadratics: given ax² + bx + c = 0, find two numbers that multiply to ac and add to b. Example: 6x² + 11x + 4. Here a=6, c=4, so ac=24. We need two numbers that multiply to 24 and add to 11: they are 3 and 8. Rewrite: 6x² + 3x + 8x + 4, then factor by grouping: 3x(2x+1) + 4(2x+1) = (3x+4)(2x+1). The quadratic formula x = (−b ± √(b²−4ac)) / 2a works when factorisation is not obvious — and it always works. Completing the square is useful for deriving the vertex form of a parabola, which appears in coordinate geometry questions. Practise five factorisation problems daily for two weeks and the patterns become instinctive.',
                'status'      => 'PUBLISHED',
            ],
            [
                'title'       => 'Statistics in WAEC: Mean, Median, Mode and Beyond',
                'slug'        => 'statistics-in-waec-mean-median-mode',
                'category'    => 'mathematics',
                'image'       => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&q=80',
                'content'     => 'Statistics questions in WAEC consistently yield high marks for prepared students and lost marks for those who rush. The three measures of central tendency — mean, median, and mode — are just the beginning. The mean is the sum of all values divided by the count. For grouped data, use the midpoint of each class interval multiplied by its frequency, sum those products, and divide by total frequency. The median is the middle value when data is ordered. For grouped data, use the formula: L + ((n/2 − F) / f) × h, where L is the lower class boundary, F is the cumulative frequency before the median class, f is the frequency of the median class, and h is the class width. Practise identifying the correct formula from the question wording. Mode is the most frequent value — straightforward for raw data, but modal class for grouped data. Beyond averages, WAEC tests standard deviation, cumulative frequency curves (ogives), histograms, and bar charts. Always label axes and title your graph — unlabelled graphs lose presentation marks.',
                'status'      => 'PUBLISHED',
            ],

            // ── Career & University ────────────────────────────────────────────
            [
                'title'       => "Nigeria's Top Universities in 2026: What to Expect",
                'slug'        => 'nigerias-top-universities-2026-what-to-expect',
                'category'    => 'career-university',
                'image'       => 'https://images.unsplash.com/photo-1562774053-701939374585?w=800&q=80',
                'content'     => 'University of Lagos, University of Ibadan, Obafemi Awolowo University, University of Nigeria Nsukka, and Ahmadu Bello University consistently top domestic rankings. But what should you actually expect when you arrive? Cut-off marks for competitive courses like Medicine at UNILAG have hovered between 280 and 300 in recent UTME cycles — national cut-off of 200 is merely the floor, not the target. Campus life varies enormously: UI and OAU have large verdant campuses with rich extracurricular cultures, while UNILAG sits in urban Lagos with direct industry access. Accommodation is a significant variable. Most federal universities cannot house all students; securing off-campus housing near campus early is critical. Research each institution\'s departmental cut-off for your target course — not just the general institution cut-off. Visit the JAMB brochure and each school\'s admissions page for the official requirements. Gap-year consideration: if your UTME score falls short, a structured gap year with targeted retake preparation consistently outperforms applying to your second-choice course at a first-choice school.',
                'status'      => 'PUBLISHED',
            ],
            [
                'title'       => 'From SSCE to University: Building a Competitive Application',
                'slug'        => 'from-ssce-to-university-competitive-application',
                'category'    => 'career-university',
                'image'       => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800&q=80',
                'content'     => 'Nigerian university admission is a two-key lock: your WAEC/NECO result and your UTME score must both be strong. Neglecting either breaks the chain. But increasingly, universities — especially those with scholarship schemes — look at a fuller profile. Extracurricular involvement matters more than students realise. National mathematics or science competition results, community leadership roles, and verifiable project work all strengthen your post-UTME interview performance. Start building evidence from SS2: photograph events you organise, save certificates, and keep a simple portfolio document. Personal statements are not yet standard in Nigerian public universities, but private institutions and scholarship bodies do require them. Practice articulating why you want to study your chosen course in two clear paragraphs: what drew you to it, and what you plan to do with it. Vague passion ("I love helping people") is far weaker than specific motivation ("Watching my cousin receive inadequate care at a general hospital made me determined to improve rural healthcare delivery"). Specificity signals sincerity.',
                'status'      => 'PUBLISHED',
            ],
        ];

        foreach ($articles as $article) {
            $cat = $categories[$article['category']] ?? null;
            if (!$cat) continue;

            Blog::firstOrCreate(
                ['slug' => $article['slug']],
                [
                    'title'       => $article['title'],
                    'category_id' => $cat->id,
                    'image'       => $article['image'],
                    'content'     => $article['content'],
                    'status'      => $article['status'],
                ]
            );
        }
    }
}
