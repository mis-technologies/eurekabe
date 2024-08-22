<?php

namespace Modules\Exam\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
    */
    public function run()
    {
        DB::table('questions')->insert(array (
  0 => 
  array (
    'id' => 6,
    'exam_id' => 1,
    'question' => '<div>From the statement below, the qualities of a&nbsp;</div><div>good thermometer are&nbsp;</div><div>(i) High thermal capacity&nbsp;</div><div>(ii) high sensibility&nbsp;</div><div>(iii) Easy readability&nbsp;</div><div>(iv) Accuracy over a wide range of&nbsp;</div><div>temperature&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 02:51:12',
    'updated_at' => '2023-02-17 06:35:50',
  ),
  1 => 
  array (
    'id' => 7,
    'exam_id' => 1,
    'question' => 'The temperature 45oC is the same as<br>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 03:23:53',
    'updated_at' => '2023-02-17 06:36:15',
  ),
  2 => 
  array (
    'id' => 8,
    'exam_id' => 1,
    'question' => '<div>The thermometric property of a thermocouple&nbsp;</div><div>is the change in _______.&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 03:27:40',
    'updated_at' => '2023-02-17 06:36:37',
  ),
  3 => 
  array (
    'id' => 9,
    'exam_id' => 1,
    'question' => '<div>A thermometer with an arbitrary scale Y&nbsp;</div><div>registers -50oY at the lower fixed point and&nbsp;</div><div>+70oY at the upper fixed point. The Celsius&nbsp;</div><div>temperature corresponding to 30oY is&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 03:30:46',
    'updated_at' => '2023-02-17 06:36:57',
  ),
  4 => 
  array (
    'id' => 10,
    'exam_id' => 1,
    'question' => '<div>The heat required to raise the temperature of&nbsp;</div><div>one mole of a gas by 1K is&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 03:34:10',
    'updated_at' => '2023-02-17 06:37:17',
  ),
  5 => 
  array (
    'id' => 11,
    'exam_id' => 1,
    'question' => 'Fahrenheit and Celsius readings are the same<br>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 03:39:21',
    'updated_at' => '2023-02-17 06:37:46',
  ),
  6 => 
  array (
    'id' => 12,
    'exam_id' => 1,
    'question' => '<div>At what temperature is the Fahrenheit scale&nbsp;</div><div>twice the Centigrade scale?&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 03:44:02',
    'updated_at' => '2023-02-17 06:38:07',
  ),
  7 => 
  array (
    'id' => 13,
    'exam_id' => 1,
    'question' => '<div>Calculate the Celsius scale equivalent of a&nbsp;</div><div>temperature of 300K room temperature</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 03:47:31',
    'updated_at' => '2023-02-17 06:38:33',
  ),
  8 => 
  array (
    'id' => 14,
    'exam_id' => 1,
    'question' => 'Hot water is added to three times the mass of 
<div>water at 100C and the resulting temperature 
</div><div>is 200C. What is the initial temperature of the 
</div><div>hot water?&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 10:56:57',
    'updated_at' => '2023-02-17 19:03:48',
  ),
  9 => 
  array (
    'id' => 15,
    'exam_id' => 1,
    'question' => 'Specific heat is defined in term of;<br>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 11:01:14',
    'updated_at' => '2023-02-17 19:04:10',
  ),
  10 => 
  array (
    'id' => 16,
    'exam_id' => 1,
    'question' => '<div>A body mass 120g and specific heat capacity&nbsp;</div><div>of 400Jkg-1K-1 losses 240J of heat energy. The&nbsp;</div><div>change in temperature of the body is&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 11:05:45',
    'updated_at' => '2023-02-17 19:05:19',
  ),
  11 => 
  array (
    'id' => 17,
    'exam_id' => 1,
    'question' => '<div>The specific heat capacity of water is 4.2Jg-1K￾1 and the specific latent heat of vapourisation&nbsp;</div><div>of water is 2260Jg-1. The heat required to&nbsp;</div><div>vapourise 200g water initially at 80oC is&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 11:20:32',
    'updated_at' => '2023-02-17 19:05:36',
  ),
  12 => 
  array (
    'id' => 18,
    'exam_id' => 1,
    'question' => '<div>A metal of volume 40cm3 and linear&nbsp;</div><div>expansivity 1.94 × 10−5</div><div>is heated from 300C&nbsp;</div><div>to 900C, the increase in volume is&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 11:24:01',
    'updated_at' => '2023-02-17 19:05:54',
  ),
  13 => 
  array (
    'id' => 19,
    'exam_id' => 1,
    'question' => 'A wire of length 5m is heated from a 
<div>temperature of 10oC to 60oC. If it undergoes a 
</div><div>change of length of 20mm, the linear 
</div><div>expansivity of the wire is&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 11:26:52',
    'updated_at' => '2023-02-17 19:04:55',
  ),
  14 => 
  array (
    'id' => 20,
    'exam_id' => 1,
    'question' => '<div>A telegraph wire of length 100.0m at 30oC&nbsp;</div><div>has linear expansivity of 2 x 10-5K-1. The&nbsp;</div><div>length of the wire at a temperature of -10oC is</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 11:29:20',
    'updated_at' => '2023-02-17 19:04:39',
  ),
  15 => 
  array (
    'id' => 21,
    'exam_id' => 1,
    'question' => 'In NaCl, Na ions are positively charged and 
<div>chlorine ions are negatively charged. Despite 
</div><div>the coulomb’s attraction between them, why
</div><div>do the two ions not collapse?&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 11:38:47',
    'updated_at' => '2023-02-17 19:06:36',
  ),
  16 => 
  array (
    'id' => 22,
    'exam_id' => 1,
    'question' => '<div>The difference observed in solids, liquids and</div><div>gas may be accounted for by&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 11:43:54',
    'updated_at' => '2023-02-17 19:06:55',
  ),
  17 => 
  array (
    'id' => 23,
    'exam_id' => 1,
    'question' => '<div>Two atoms are scrutinized. Their nuclei have&nbsp;</div><div>the same number of protons, but one nucleus</div><div>has two neutrons more than the other, these&nbsp;</div><div>atoms represent;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 11:50:18',
    'updated_at' => '2023-02-17 19:07:30',
  ),
  18 => 
  array (
    'id' => 24,
    'exam_id' => 1,
    'question' => '<div>Which of the following statements is correct&nbsp;</div><div>about evaporation and boiling&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 11:53:12',
    'updated_at' => '2023-02-17 19:07:58',
  ),
  19 => 
  array (
    'id' => 25,
    'exam_id' => 1,
    'question' => '<div>In the process of evaporation, a state of&nbsp;</div><div>affairs is reached at the surface of the liquid&nbsp;</div><div>in which molecules are arriving and&nbsp;</div><div>departing at the same rate is called?&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 11:56:04',
    'updated_at' => '2023-02-17 19:08:49',
  ),
  20 => 
  array (
    'id' => 26,
    'exam_id' => 1,
    'question' => '<div>The pressure of a constant volume gas&nbsp;</div><div>thermometer is 1500N/m2 at 280C. What will&nbsp;</div><div>be the temperature of the gas when the&nbsp;</div><div>pressure is increased by one-third</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 16:52:48',
    'updated_at' => '2023-02-17 19:09:17',
  ),
  21 => 
  array (
    'id' => 27,
    'exam_id' => 1,
    'question' => '<div>The pressure of a constant volume gas&nbsp;</div><div>thermometer is 1500N/m2 at 280C. What will&nbsp;</div><div>be the temperature of the gas when the&nbsp;</div><div>pressure is increased by one-third</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 16:52:52',
    'updated_at' => '2023-02-17 19:09:46',
  ),
  22 => 
  array (
    'id' => 28,
    'exam_id' => 1,
    'question' => '<div>Which of the following phenomena CANNOT</div><div>be explained by the molecular theory of&nbsp;</div><div>matter?&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 16:59:06',
    'updated_at' => '2023-02-17 19:20:56',
  ),
  23 => 
  array (
    'id' => 29,
    'exam_id' => 1,
    'question' => '<div>When two bodies are in thermal contact and&nbsp;</div><div>there is no net transfer of heat the bodies are&nbsp;</div><div>said to be in&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:02:35',
    'updated_at' => '2023-02-17 19:22:01',
  ),
  24 => 
  array (
    'id' => 30,
    'exam_id' => 1,
    'question' => '<div>What is the average speed of oxygen gas&nbsp;</div><div>molecules at T= 300K&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:06:13',
    'updated_at' => '2023-02-17 19:22:36',
  ),
  25 => 
  array (
    'id' => 31,
    'exam_id' => 1,
    'question' => '<div>The energy in a system, whether transferred&nbsp;</div><div>to it as heat or work is called&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:08:42',
    'updated_at' => '2023-02-17 19:23:20',
  ),
  26 => 
  array (
    'id' => 32,
    'exam_id' => 1,
    'question' => '<div>Calculate the work done by 1 mole of an ideal&nbsp;</div><div>gas that is kept at 0oC in an expansion from 3&nbsp;</div><div>to10 liters.</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:12:40',
    'updated_at' => '2023-02-17 19:23:43',
  ),
  27 => 
  array (
    'id' => 33,
    'exam_id' => 1,
    'question' => '<div>Nine particles have speeds of 5, 8, 12, 12, 12,&nbsp;</div><div>14, 14, 17 and 10m/s. Find the root mean&nbsp;</div><div>square speed.</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:17:24',
    'updated_at' => '2023-02-17 19:24:14',
  ),
  28 => 
  array (
    'id' => 34,
    'exam_id' => 1,
    'question' => '<div>The density of air of 0oC and at a pressure of&nbsp;</div><div>1.01 x 105N/m2is 1.29kg/m3. What is the&nbsp;</div><div>root mean square speed of its molecules?</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:21:43',
    'updated_at' => '2023-02-17 19:24:46',
  ),
  29 => 
  array (
    'id' => 35,
    'exam_id' => 1,
    'question' => '<div>A cubical container is filled with hydrogen&nbsp;</div><div>gas. The height and temperature of the&nbsp;</div><div>container are 2m and 0oC respectively.&nbsp;</div><div>Calculate the average translational kinetic&nbsp;</div><div>energy of a molecule&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:34:13',
    'updated_at' => '2023-02-17 19:25:18',
  ),
  30 => 
  array (
    'id' => 36,
    'exam_id' => 1,
    'question' => '<div>The deduction from the kinetic theory of&nbsp;</div><div>matter includes;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:38:39',
    'updated_at' => '2023-02-17 19:25:50',
  ),
  31 => 
  array (
    'id' => 37,
    'exam_id' => 1,
    'question' => '<div>Which of thefollowing in not a deduction&nbsp;</div><div>from the kinetic theory of matter</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:43:51',
    'updated_at' => '2023-02-17 19:26:22',
  ),
  32 => 
  array (
    'id' => 38,
    'exam_id' => 1,
    'question' => '<div>What is the total random kinetic energy of&nbsp;</div><div>the molecules in one mole of a gas at a&nbsp;</div><div>temperature of 300K?&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:46:19',
    'updated_at' => '2023-02-17 19:26:45',
  ),
  33 => 
  array (
    'id' => 39,
    'exam_id' => 1,
    'question' => '<div>What is the total random kinetic energy of&nbsp;</div><div>the molecules in one mole of a gas at a&nbsp;</div><div>temperature of 300K?&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:46:20',
    'updated_at' => '2023-02-17 19:27:06',
  ),
  34 => 
  array (
    'id' => 40,
    'exam_id' => 1,
    'question' => '<div>What is the root mean square speed of a&nbsp;</div><div>hydrogen molecule at 300K?</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:49:38',
    'updated_at' => '2023-02-17 19:27:41',
  ),
  35 => 
  array (
    'id' => 41,
    'exam_id' => 1,
    'question' => '<div>The temperature at which the volume of a&nbsp;</div><div>(i) Absolutezero of temperature&nbsp;</div><div>(ii) Having a value of -273oC&nbsp;</div><div>gas become theoretically zero is&nbsp;</div><div>(iii) Zero point energy&nbsp;</div><div>(iv) All of the above</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:54:39',
    'updated_at' => '2023-02-17 19:28:11',
  ),
  36 => 
  array (
    'id' => 42,
    'exam_id' => 1,
    'question' => '<div>At what temperature is the root-mean</div><div>the rootmeansquare speed of hydrogen&nbsp;</div><div>square speed ofnitrogen molecules equal to&nbsp;</div><div>moleculesat 20oC&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:56:40',
    'updated_at' => '2023-02-17 19:28:57',
  ),
  37 => 
  array (
    'id' => 43,
    'exam_id' => 1,
    'question' => '<div>For real gases the internal energy depends&nbsp;</div><div>on?</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 17:59:25',
    'updated_at' => '2023-02-17 19:29:23',
  ),
  38 => 
  array (
    'id' => 44,
    'exam_id' => 1,
    'question' => '<div>The nature of the Vander Waal’s equation is&nbsp;</div><div>that all isotherm below critical temperature&nbsp;</div><div>have&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 18:05:32',
    'updated_at' => '2023-02-17 19:29:45',
  ),
  39 => 
  array (
    'id' => 45,
    'exam_id' => 1,
    'question' => '<div>In the Vander Waal’s equation for real gas,&nbsp;</div><div>the term 𝑎</div><div>2</div><div>is called&nbsp;</div><div>𝑣</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 18:08:37',
    'updated_at' => '2023-02-17 19:30:09',
  ),
  40 => 
  array (
    'id' => 46,
    'exam_id' => 1,
    'question' => '<div>In the Vander Waal’s equation for real gas,&nbsp;</div><div>the term 𝑎</div><div>2</div><div>is called&nbsp;</div><div>𝑣</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 18:08:37',
    'updated_at' => '2023-02-17 19:30:36',
  ),
  41 => 
  array (
    'id' => 47,
    'exam_id' => 1,
    'question' => '<div>Which of the following statement about a&nbsp;</div><div>critical temperature is correct</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 18:11:43',
    'updated_at' => '2023-02-17 19:31:00',
  ),
  42 => 
  array (
    'id' => 48,
    'exam_id' => 1,
    'question' => '<div>For an ideal gas the kinetic energy at&nbsp;</div><div>absolute zero temperature is 0.&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 19:34:10',
    'updated_at' => '2023-02-17 19:34:10',
  ),
  43 => 
  array (
    'id' => 49,
    'exam_id' => 1,
    'question' => '<div>For a real gas the kinetic energy at absolute&nbsp;</div><div>zero temperature is 0.&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 19:35:59',
    'updated_at' => '2023-02-17 19:35:59',
  ),
  44 => 
  array (
    'id' => 50,
    'exam_id' => 1,
    'question' => '<div>The nature of the Vander Waals equation is&nbsp;</div><div>that all isotherms below the critical points&nbsp;</div><div>have ___ points.&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 19:37:32',
    'updated_at' => '2023-02-17 19:37:32',
  ),
  45 => 
  array (
    'id' => 51,
    'exam_id' => 1,
    'question' => '<div>The Vander Waal’s equation explains the&nbsp;</div><div>behavior of real gases below the critical&nbsp;</div><div>temperature?&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 19:38:52',
    'updated_at' => '2023-02-17 19:38:52',
  ),
  46 => 
  array (
    'id' => 52,
    'exam_id' => 1,
    'question' => '<div>During an adiabatic expansion of 5 moles of&nbsp;</div><div>gas, the internal energy decreases by 75J. The&nbsp;</div><div>work done during the process is&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 19:41:44',
    'updated_at' => '2023-02-17 19:41:44',
  ),
  47 => 
  array (
    'id' => 53,
    'exam_id' => 1,
    'question' => '<div>At the boiling of water the saturated vapour&nbsp;</div><div>pressure will be (in mm of Hg)&nbsp;</div>',
    'marks' => 1.112,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-02-17 19:44:55',
    'updated_at' => '2023-02-17 19:44:55',
  ),
  48 => 
  array (
    'id' => 54,
    'exam_id' => 3,
    'question' => 'Write a story about your idea in tech',
    'marks' => 70.0,
    'written_ans' => 'My story about myself in the tech space.',
    'status' => 1,
    'created_at' => '2023-05-04 18:31:17',
    'updated_at' => '2023-05-04 18:31:17',
  ),
  49 => 
  array (
    'id' => 55,
    'exam_id' => 4,
    'question' => 'Find dy/dx if x - y = 1<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-10 07:06:04',
    'updated_at' => '2023-05-10 07:06:04',
  ),
  50 => 
  array (
    'id' => 56,
    'exam_id' => 4,
    'question' => '&nbsp;Find dy/dx when xy = 1<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-10 07:07:18',
    'updated_at' => '2023-05-10 07:07:18',
  ),
  51 => 
  array (
    'id' => 57,
    'exam_id' => 4,
    'question' => '&nbsp;x + y = 2 xy find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-10 07:08:11',
    'updated_at' => '2023-05-10 07:08:11',
  ),
  52 => 
  array (
    'id' => 58,
    'exam_id' => 4,
    'question' => ') If 2 x y = 3, find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-10 07:08:58',
    'updated_at' => '2023-05-10 07:08:58',
  ),
  53 => 
  array (
    'id' => 59,
    'exam_id' => 4,
    'question' => 'Let x + y + xy = 3. Find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-10 07:09:43',
    'updated_at' => '2023-05-10 07:09:43',
  ),
  54 => 
  array (
    'id' => 60,
    'exam_id' => 5,
    'question' => 'Given that y = 2x - 3x + x, find dy/dx at x = 1<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-11 23:47:49',
    'updated_at' => '2023-05-11 23:47:49',
  ),
  55 => 
  array (
    'id' => 61,
    'exam_id' => 6,
    'question' => '(1)Finddy/dxifx2 -y2 =1<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-12 20:06:00',
    'updated_at' => '2023-05-12 20:06:00',
  ),
  56 => 
  array (
    'id' => 62,
    'exam_id' => 6,
    'question' => '(2) Find dy/dx when xy = 1<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-13 22:18:26',
    'updated_at' => '2023-05-13 22:18:26',
  ),
  57 => 
  array (
    'id' => 63,
    'exam_id' => 6,
    'question' => '(3) x + y = 2 xy find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-13 22:19:48',
    'updated_at' => '2023-05-13 22:19:48',
  ),
  58 => 
  array (
    'id' => 64,
    'exam_id' => 6,
    'question' => '(4) If 2 x y = 3, find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-13 22:23:33',
    'updated_at' => '2023-05-13 22:23:33',
  ),
  59 => 
  array (
    'id' => 65,
    'exam_id' => 6,
    'question' => '(5) Let x + y + xy = 3. Find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-13 22:39:09',
    'updated_at' => '2023-05-13 22:39:09',
  ),
  60 => 
  array (
    'id' => 66,
    'exam_id' => 6,
    'question' => '(6) x y - x - y = 0, find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-13 22:40:58',
    'updated_at' => '2023-05-13 22:40:58',
  ),
  61 => 
  array (
    'id' => 67,
    'exam_id' => 6,
    'question' => '(7) Let y = 2x + x + 1, find d y/d x<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-13 22:43:36',
    'updated_at' => '2023-05-13 22:43:36',
  ),
  62 => 
  array (
    'id' => 68,
    'exam_id' => 6,
    'question' => 'f(x) = (x - 2)(4 x + 1), find d f /dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-13 22:45:57',
    'updated_at' => '2023-05-13 22:45:57',
  ),
  63 => 
  array (
    'id' => 69,
    'exam_id' => 6,
    'question' => '&nbsp;If y = 1/x, find d y dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-13 22:47:28',
    'updated_at' => '2023-05-13 22:47:28',
  ),
  64 => 
  array (
    'id' => 70,
    'exam_id' => 6,
    'question' => 'y = 2x - 1, find d y/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-13 22:48:50',
    'updated_at' => '2023-05-13 22:48:50',
  ),
  65 => 
  array (
    'id' => 71,
    'exam_id' => 6,
    'question' => '&nbsp;y = (1 - 2x)<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-13 22:50:43',
    'updated_at' => '2023-05-13 22:50:43',
  ),
  66 => 
  array (
    'id' => 72,
    'exam_id' => 6,
    'question' => 'y = sin 3 x find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-13 22:52:43',
    'updated_at' => '2023-05-13 22:52:43',
  ),
  67 => 
  array (
    'id' => 73,
    'exam_id' => 6,
    'question' => 'If y = (sinx) , obtain dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-21 03:19:16',
    'updated_at' => '2023-05-21 03:19:16',
  ),
  68 => 
  array (
    'id' => 74,
    'exam_id' => 6,
    'question' => 'y = sin 2x, find dy/dx<br>',
    'marks' => 2.1,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 06:35:29',
    'updated_at' => '2023-05-29 06:35:29',
  ),
  69 => 
  array (
    'id' => 75,
    'exam_id' => 6,
    'question' => 'If y = (sinx) , obtain dy/dx<br>',
    'marks' => 2.1,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 06:37:35',
    'updated_at' => '2023-05-29 06:37:35',
  ),
  70 => 
  array (
    'id' => 76,
    'exam_id' => 6,
    'question' => 'Differentiate with respect to x, given y = sin x<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 06:39:49',
    'updated_at' => '2023-05-29 06:39:49',
  ),
  71 => 
  array (
    'id' => 77,
    'exam_id' => 6,
    'question' => 'If q = sinx cosx find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 06:41:36',
    'updated_at' => '2023-05-29 06:41:36',
  ),
  72 => 
  array (
    'id' => 78,
    'exam_id' => 6,
    'question' => 'Given that y = 2x - 3x + x, find dy/dx at x =<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 06:43:28',
    'updated_at' => '2023-05-29 06:43:28',
  ),
  73 => 
  array (
    'id' => 79,
    'exam_id' => 6,
    'question' => 'Find the tangent to the curve y = x - x - 6 at x = 1/<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 06:44:36',
    'updated_at' => '2023-05-29 06:44:36',
  ),
  74 => 
  array (
    'id' => 80,
    'exam_id' => 6,
    'question' => 'Given y = log x , find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 06:46:49',
    'updated_at' => '2023-05-29 06:46:49',
  ),
  75 => 
  array (
    'id' => 81,
    'exam_id' => 6,
    'question' => 'Given y = log(1 - x ), find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 06:48:57',
    'updated_at' => '2023-05-29 06:48:57',
  ),
  76 => 
  array (
    'id' => 82,
    'exam_id' => 6,
    'question' => 'Let v = t - 2t + t gives the velocity of an object at time t (we define acceleration as change in velocity with time). Obtain an expression for the acceleration of the object<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 06:51:20',
    'updated_at' => '2023-05-29 06:51:20',
  ),
  77 => 
  array (
    'id' => 83,
    'exam_id' => 6,
    'question' => 'Find dy/dx if y = cos2x<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 06:54:31',
    'updated_at' => '2023-05-29 06:54:31',
  ),
  78 => 
  array (
    'id' => 84,
    'exam_id' => 6,
    'question' => 'find dy/dx for y = cos x<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 06:56:15',
    'updated_at' => '2023-05-29 06:56:15',
  ),
  79 => 
  array (
    'id' => 85,
    'exam_id' => 6,
    'question' => 'y = sin (3x), find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 06:58:10',
    'updated_at' => '2023-05-29 06:58:10',
  ),
  80 => 
  array (
    'id' => 86,
    'exam_id' => 6,
    'question' => 'Find the differential coefficient of y with respect to x given that y = (3x - 4)<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:00:58',
    'updated_at' => '2023-05-29 07:00:58',
  ),
  81 => 
  array (
    'id' => 87,
    'exam_id' => 6,
    'question' => 'If v = sin u, d v/du is what?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:02:17',
    'updated_at' => '2023-05-29 07:02:17',
  ),
  82 => 
  array (
    'id' => 88,
    'exam_id' => 6,
    'question' => 'If y = tan x, find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:04:40',
    'updated_at' => '2023-05-29 07:04:40',
  ),
  83 => 
  array (
    'id' => 89,
    'exam_id' => 6,
    'question' => 'Given y = 2xcosx, find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:06:22',
    'updated_at' => '2023-05-29 07:06:22',
  ),
  84 => 
  array (
    'id' => 90,
    'exam_id' => 6,
    'question' => 'Given that y = (1 - 2x ) , find dy/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:07:58',
    'updated_at' => '2023-05-29 07:07:58',
  ),
  85 => 
  array (
    'id' => 91,
    'exam_id' => 6,
    'question' => 'Obtain the limit of (x + 1) as x--&gt; 2<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:09:07',
    'updated_at' => '2023-05-29 07:09:07',
  ),
  86 => 
  array (
    'id' => 92,
    'exam_id' => 6,
    'question' => 'Obtain the limit of 1/x : x--&gt;0<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:10:16',
    'updated_at' => '2023-05-29 07:10:16',
  ),
  87 => 
  array (
    'id' => 93,
    'exam_id' => 6,
    'question' => 'Obtain the limit of 2(x - 1) : x--&gt;2<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:11:28',
    'updated_at' => '2023-05-29 07:11:28',
  ),
  88 => 
  array (
    'id' => 94,
    'exam_id' => 6,
    'question' => 'Given y = sec x, find dy/dx (Hint let = 1/cosx)<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:12:42',
    'updated_at' => '2023-05-29 07:12:42',
  ),
  89 => 
  array (
    'id' => 95,
    'exam_id' => 6,
    'question' => 'u = tan (3v ), obtain du/dv<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:14:26',
    'updated_at' => '2023-05-29 07:14:26',
  ),
  90 => 
  array (
    'id' => 96,
    'exam_id' => 6,
    'question' => 'Find dy/dx where y = cos 6x<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:16:07',
    'updated_at' => '2023-05-29 07:16:07',
  ),
  91 => 
  array (
    'id' => 97,
    'exam_id' => 6,
    'question' => 'If y = uvw where u, v and w are functions of x. express dv/dx<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:18:06',
    'updated_at' => '2023-05-29 07:18:06',
  ),
  92 => 
  array (
    'id' => 98,
    'exam_id' => 6,
    'question' => 'f y = kx where (k = constant) dy /dx is what?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:19:26',
    'updated_at' => '2023-05-29 07:19:26',
  ),
  93 => 
  array (
    'id' => 99,
    'exam_id' => 6,
    'question' => 'Given that t = 5k. where k is constant, obtain dt/dk [A] 5<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:20:26',
    'updated_at' => '2023-05-29 07:20:26',
  ),
  94 => 
  array (
    'id' => 100,
    'exam_id' => 6,
    'question' => 'Given that t = 5k. where k is constant, obtain dt/dk [A] 5<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-29 07:21:51',
    'updated_at' => '2023-05-29 07:21:51',
  ),
  95 => 
  array (
    'id' => 101,
    'exam_id' => 7,
    'question' => 'A chemical reaction is said to be at equilibrium at.&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:02:47',
    'updated_at' => '2023-05-30 05:02:47',
  ),
  96 => 
  array (
    'id' => 102,
    'exam_id' => 7,
    'question' => 'Predict the spontaneity of a chemical process if &amp;Delta;G&lt;sup&gt;o&lt;/sup&gt; = 141.7 and K = 1.4 x 10&lt;sup&gt;-25&lt;/sup&gt; at 298K.&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:05:04',
    'updated_at' => '2023-05-30 05:05:04',
  ),
  97 => 
  array (
    'id' => 103,
    'exam_id' => 7,
    'question' => 'Estimate the boiling point of water given &amp;Delta;H&lt;sup&gt;o&lt;/sup&gt; = 44.01KJmol&lt;sup&gt;-1&lt;/sup&gt; and &amp;Delta;S&lt;sup&gt;o&lt;/sup&gt; = 118.3 J/Kmol&lt;sup&gt;-1&lt;/sup&gt;.&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:07:53',
    'updated_at' => '2023-05-30 05:07:53',
  ),
  98 => 
  array (
    'id' => 104,
    'exam_id' => 7,
    'question' => 'Which of the following statements is true for the effect of catalyst on equilibrium.&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:10:59',
    'updated_at' => '2023-05-30 05:10:59',
  ),
  99 => 
  array (
    'id' => 105,
    'exam_id' => 7,
    'question' => 'Which of the following principles is used in predicting changes in equilibrium concentrations?&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:13:02',
    'updated_at' => '2023-05-30 05:13:02',
  ),
  100 => 
  array (
    'id' => 106,
    'exam_id' => 7,
    'question' => 'The following reaction is at equilibrium. &lt;br /&gt; C&lt;sub&gt;l2&lt;/sub&gt; (g) + 3F&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2ClF&lt;sub&gt;3&lt;/sub&gt; (g) &lt;br /&gt; How will the system respond if the volume is increased at constant Temperature&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:15:50',
    'updated_at' => '2023-05-30 05:15:50',
  ),
  101 => 
  array (
    'id' => 107,
    'exam_id' => 7,
    'question' => 'The following reaction is at equilibrium. &lt;br /&gt; CF&lt;sub&gt;2&lt;/sub&gt; Br&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; CF&lt;sub&gt;2&lt;/sub&gt; (g) + 2Br(g) &amp;Delta;H= 424 kJ mol&lt;sup&gt;–1&lt;/sup&gt; &lt;br /&gt; How will the system respond if the temperature is decreased?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:18:11',
    'updated_at' => '2023-05-30 05:18:11',
  ),
  102 => 
  array (
    'id' => 108,
    'exam_id' => 7,
    'question' => 'Consider this equation: 2CO(g) + O&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2CO&lt;sub&gt;2&lt;/sub&gt; (g) &lt;br /&gt; Suppose the equation is rewritten as CO(g) + 1⁄2O&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; CO&lt;sub&gt;2&lt;/sub&gt; (g)<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:22:33',
    'updated_at' => '2023-05-30 05:22:33',
  ),
  103 => 
  array (
    'id' => 109,
    'exam_id' => 7,
    'question' => 'Identify the INCORRECT statement below regarding chemical equilibrium.&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:27:09',
    'updated_at' => '2023-05-30 05:27:09',
  ),
  104 => 
  array (
    'id' => 110,
    'exam_id' => 7,
    'question' => 'In which of the following reactions will the point of equilibrium shift to the left when the pressure on the system is increased?&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:30:37',
    'updated_at' => '2023-05-30 05:30:37',
  ),
  105 => 
  array (
    'id' => 111,
    'exam_id' => 7,
    'question' => '<div>s)</div><div>What happens when a catalyst is added to a system at equilibrium</div>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:32:30',
    'updated_at' => '2023-05-30 05:32:30',
  ),
  106 => 
  array (
    'id' => 112,
    'exam_id' => 7,
    'question' => 'The reaction A &amp;harr; B has an equilibrium constant of K = 10&lt;sup&gt;–4&lt;/sup&gt; . Which of the following statements is always correct? A: The reaction will have 50% product B and 50% reactant<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:35:37',
    'updated_at' => '2023-05-30 05:35:37',
  ),
  107 => 
  array (
    'id' => 113,
    'exam_id' => 7,
    'question' => 'Which of the following statements most accurately relates the properties of a liquid at room temperature with its vapour pressure?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:38:09',
    'updated_at' => '2023-05-30 05:38:09',
  ),
  108 => 
  array (
    'id' => 114,
    'exam_id' => 7,
    'question' => 'Which of the following is true for the composition of equilibrium mixture. If &amp;Delta;G = 0 and&lt;i&gt; K&lt;/i&gt; = 1 the mixture is.<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:40:41',
    'updated_at' => '2023-05-30 05:40:41',
  ),
  109 => 
  array (
    'id' => 115,
    'exam_id' => 7,
    'question' => 'Which of the following is true for the composition of equilibrium mixture. If &amp;Delta;G = 0 and&lt;i&gt; K&lt;/i&gt; = 1 the mixture is.<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:40:42',
    'updated_at' => '2023-05-30 05:40:42',
  ),
  110 => 
  array (
    'id' => 116,
    'exam_id' => 7,
    'question' => 'Calculate the value of K at 298K for the following reaction N&lt;sub&gt;2&lt;/sub&gt; (g) + 3H&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2NH&lt;sub&gt;3&lt;/sub&gt; (g) &lt;br /&gt; Given &amp;Delta;G = -32.96KJmol-1<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:44:17',
    'updated_at' => '2023-05-30 05:44:17',
  ),
  111 => 
  array (
    'id' => 117,
    'exam_id' => 7,
    'question' => 'Of the following reactions, which of the reaction process is only spontaneous at high temperatures<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:46:35',
    'updated_at' => '2023-05-30 05:46:35',
  ),
  112 => 
  array (
    'id' => 118,
    'exam_id' => 7,
    'question' => 'O&lt;sub&gt;2&lt;/sub&gt; (g) &amp;rarr;2CO(g) &lt;br /&gt; How does the spontaneity of this process depend upon temperature?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:51:14',
    'updated_at' => '2023-05-30 05:51:14',
  ),
  113 => 
  array (
    'id' => 119,
    'exam_id' => 7,
    'question' => 'condition of a predation process describes an endothermic process with an increase in system entropy, ?G will be negative if.&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:54:28',
    'updated_at' => '2023-05-30 05:54:28',
  ),
  114 => 
  array (
    'id' => 120,
    'exam_id' => 7,
    'question' => 'At 25&lt;sup&gt;?&lt;/sup&gt;C, a reaction has a Gibb\'s free energy change of +45kJ. If the enthalpy change of the reaction is +35kJ, what is the entropy change of the reaction?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 05:56:26',
    'updated_at' => '2023-05-30 05:56:26',
  ),
  115 => 
  array (
    'id' => 121,
    'exam_id' => 7,
    'question' => 'Energy can neither be created nor destroyed but can be converted from one form to other is inferred from.&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 20:47:32',
    'updated_at' => '2023-05-30 20:47:32',
  ),
  116 => 
  array (
    'id' => 122,
    'exam_id' => 7,
    'question' => 'From the eqution 2NO&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; N&lt;sub&gt;2&lt;/sub&gt; O&lt;sub&gt;4&lt;/sub&gt; (g) &lt;br /&gt; When the value of the reaction quotient before any reaction occurs is zero (0 ) at 25 °C, the concentration changes so that at equilibrium, [NO&lt;sub&gt;2&lt;/sub&gt; ] = 0.016 M and [N&lt;sub&gt;2&lt;/sub&gt; O&lt;sub&gt;4&lt;/sub&gt; ] = 0.042 M. &lt;br /&gt; What is the value of the equilibrium constant for the reaction?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 20:50:36',
    'updated_at' => '2023-05-30 20:50:36',
  ),
  117 => 
  array (
    'id' => 123,
    'exam_id' => 7,
    'question' => '<div><span style="color: rgb(33, 37, 41); font-size: 1rem; -webkit-tap-highlight-color: transparent;">A&nbsp;</span><span style="color: rgb(33, 37, 41); font-size: 1rem; -webkit-tap-highlight-color: transparent; -webkit-text-size-adjust: 100%;">1.00-L flask containing 0.0500 mol of NO(g), 0.0155 mol of Cl2(g), and 0.500 mol of NOCl &lt;br /&gt; 2NO(g) + Cl&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2NOCl(g) &lt;i&gt;K&lt;sub&gt;c&lt;/sub&gt; &lt;/i&gt; = 4.6 × 104 &lt;br /&gt;</span><span style="color: rgb(33, 37, 41); font-size: 1rem; -webkit-tap-highlight-color: transparent; -webkit-text-size-adjust: 100%;">&nbsp;Calculate the reaction quotient and determine the direction of the equilibrium shift</span><br></div>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 20:54:52',
    'updated_at' => '2023-05-30 20:54:52',
  ),
  118 => 
  array (
    'id' => 124,
    'exam_id' => 7,
    'question' => 'Which of the statements defines the&lt;b&gt; activity&lt;/b&gt; of a substance<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 20:57:26',
    'updated_at' => '2023-05-30 20:57:26',
  ),
  119 => 
  array (
    'id' => 125,
    'exam_id' => 7,
    'question' => 'A system in which reactants and products are found in two or more phases is a<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 20:59:48',
    'updated_at' => '2023-05-30 20:59:48',
  ),
  120 => 
  array (
    'id' => 126,
    'exam_id' => 7,
    'question' => 'One of the following is an example of heterogeneous equilibria<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:02:10',
    'updated_at' => '2023-05-30 21:02:10',
  ),
  121 => 
  array (
    'id' => 127,
    'exam_id' => 7,
    'question' => 'A chemical reaction is said to be at equilibrium at.&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:04:00',
    'updated_at' => '2023-05-30 21:04:00',
  ),
  122 => 
  array (
    'id' => 128,
    'exam_id' => 7,
    'question' => 'Predict the spontaneity of a chemical process if &amp;Delta;G&lt;sup&gt;o&lt;/sup&gt; = 141.7 and K = 1.4 x 10&lt;sup&gt;-25&lt;/sup&gt; at 298K.<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:05:55',
    'updated_at' => '2023-05-30 21:05:55',
  ),
  123 => 
  array (
    'id' => 129,
    'exam_id' => 7,
    'question' => 'Estimate the boiling point of water given &amp;Delta;H&lt;sup&gt;o&lt;/sup&gt; = 44.01KJmol&lt;sup&gt;-1&lt;/sup&gt; and &amp;Delta;S&lt;sup&gt;o&lt;/sup&gt; = 118.3 J/Kmol&lt;sup&gt;-1&lt;/sup&gt;.&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:07:29',
    'updated_at' => '2023-05-30 21:07:29',
  ),
  124 => 
  array (
    'id' => 130,
    'exam_id' => 7,
    'question' => 'Which of the following statements is true for the effect of catalyst on equilibrium.&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:10:48',
    'updated_at' => '2023-05-30 21:10:48',
  ),
  125 => 
  array (
    'id' => 131,
    'exam_id' => 7,
    'question' => 'hich of the following principles is used in predicting changes in equilibrium concentrations?&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:12:19',
    'updated_at' => '2023-05-30 21:12:19',
  ),
  126 => 
  array (
    'id' => 132,
    'exam_id' => 7,
    'question' => 'The following reaction is at equilibrium. &lt;br /&gt; C&lt;sub&gt;l2&lt;/sub&gt; (g) + 3F&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2ClF&lt;sub&gt;3&lt;/sub&gt; (g) &lt;br /&gt; How will the system respond if the volume is increased at constant temperature?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:19:28',
    'updated_at' => '2023-05-30 21:19:28',
  ),
  127 => 
  array (
    'id' => 133,
    'exam_id' => 7,
    'question' => 'The following reaction is at equilibrium. &lt;br /&gt; CF&lt;sub&gt;2&lt;/sub&gt; Br&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; CF&lt;sub&gt;2&lt;/sub&gt; (g) + 2Br(g) &amp;Delta;H= 424 kJ mol&lt;sup&gt;–1&lt;/sup&gt; &lt;br /&gt; How will the system respond if the temperature is decreased?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:21:13',
    'updated_at' => '2023-05-30 21:21:13',
  ),
  128 => 
  array (
    'id' => 134,
    'exam_id' => 7,
    'question' => 'Consider this equation: 2CO(g) + O&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2CO&lt;sub&gt;2&lt;/sub&gt; (g) &lt;br /&gt; Suppose the equation is rewritten as CO(g) + 1⁄2O&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; CO&lt;sub&gt;2&lt;/sub&gt; (g) with an equilibrium constant Kc\'. What is the relationship between Kc and Kc\'?&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:23:02',
    'updated_at' => '2023-05-30 21:23:02',
  ),
  129 => 
  array (
    'id' => 135,
    'exam_id' => 7,
    'question' => 'ntify the INCORRECT statement below regarding chemical equilibrium.&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:25:16',
    'updated_at' => '2023-05-30 21:25:16',
  ),
  130 => 
  array (
    'id' => 136,
    'exam_id' => 7,
    'question' => 'In which of the following reactions will the point of equilibrium shift to the left when the pressure on the system is increased?&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:27:27',
    'updated_at' => '2023-05-30 21:27:27',
  ),
  131 => 
  array (
    'id' => 137,
    'exam_id' => 7,
    'question' => 'What happens when a catalyst is added to a system at equilibrium?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:29:10',
    'updated_at' => '2023-05-30 21:29:10',
  ),
  132 => 
  array (
    'id' => 138,
    'exam_id' => 7,
    'question' => 'The reaction A &amp;harr; B has an equilibrium constant of K = 10&lt;sup&gt;–4&lt;/sup&gt; . Which of the following statements is always correct?&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:32:19',
    'updated_at' => '2023-05-30 21:32:19',
  ),
  133 => 
  array (
    'id' => 139,
    'exam_id' => 7,
    'question' => 'Which of the following statements most accurately relates the properties of a liquid at room temperature with its vapour pressure?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:34:11',
    'updated_at' => '2023-05-30 21:34:11',
  ),
  134 => 
  array (
    'id' => 140,
    'exam_id' => 7,
    'question' => 'For a reversible reaction, the equilibrium lies to the.<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:35:25',
    'updated_at' => '2023-05-30 21:35:25',
  ),
  135 => 
  array (
    'id' => 141,
    'exam_id' => 7,
    'question' => 'Which of the following is true for the composition of equilibrium mixture. If &amp;Delta;G = 0 and&lt;i&gt; K&lt;/i&gt; = 1 the mixture is.&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:37:16',
    'updated_at' => '2023-05-30 21:37:16',
  ),
  136 => 
  array (
    'id' => 142,
    'exam_id' => 7,
    'question' => 'Calculate the value of K at 298K for the following reaction N&lt;sub&gt;2&lt;/sub&gt; (g) + 3H&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2NH&lt;sub&gt;3&lt;/sub&gt; (g) &lt;br /&gt; Given &amp;Delta;G = -32.96KJmol-1.<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:38:59',
    'updated_at' => '2023-05-30 21:38:59',
  ),
  137 => 
  array (
    'id' => 143,
    'exam_id' => 7,
    'question' => 'Of the following reactions, which of the reaction process is only spontaneous at high temperatures?&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:41:18',
    'updated_at' => '2023-05-30 21:41:18',
  ),
  138 => 
  array (
    'id' => 144,
    'exam_id' => 7,
    'question' => 'The incomplete combustion of carbon is described by the following equation &lt;br /&gt; 2C(s) + O&lt;sub&gt;2&lt;/sub&gt; (g) &amp;rarr;2CO(g) &lt;br /&gt; How does the spontaneity of this process depend upon temperature?&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:42:56',
    'updated_at' => '2023-05-30 21:42:56',
  ),
  139 => 
  array (
    'id' => 145,
    'exam_id' => 7,
    'question' => 'If &amp;Delta;H is negative and &amp;Delta;S is positive, this condition describes.<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:44:48',
    'updated_at' => '2023-05-30 21:44:48',
  ),
  140 => 
  array (
    'id' => 146,
    'exam_id' => 7,
    'question' => 'A condition of a predation process describes an endothermic process with an increase in system entropy, ?G will be negative if.&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:46:39',
    'updated_at' => '2023-05-30 21:46:39',
  ),
  141 => 
  array (
    'id' => 147,
    'exam_id' => 7,
    'question' => 'At 25&lt;sup&gt;?&lt;/sup&gt;C, a reaction has a Gibb\'s free energy change of +45kJ. If the enthalpy change of the reaction is +35kJ, what is the entropy change of the reaction?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:48:42',
    'updated_at' => '2023-05-30 21:48:42',
  ),
  142 => 
  array (
    'id' => 148,
    'exam_id' => 7,
    'question' => 'Energy can neither be created nor destroyed but can be converted from one form to other is inferred from.&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:51:36',
    'updated_at' => '2023-05-30 21:51:36',
  ),
  143 => 
  array (
    'id' => 149,
    'exam_id' => 7,
    'question' => 'From the equation 2NO&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; N&lt;sub&gt;2&lt;/sub&gt; O&lt;sub&gt;4&lt;/sub&gt; (g) &lt;br /&gt; When the value of the reaction quotient before any reaction occurs is zero (0 ) at 25 °C, the concentration changes so that at equilibrium, [NO&lt;sub&gt;2&lt;/sub&gt; ] = 0.016 M and&nbsp;N&lt;sub&gt;2&lt;/sub&gt; O&lt;sub&gt;4&lt;/sub&gt; ] = 0.042 M. &lt;br /&gt; What is the value of the equilibrium constant for the reaction?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:54:03',
    'updated_at' => '2023-05-30 21:54:03',
  ),
  144 => 
  array (
    'id' => 150,
    'exam_id' => 7,
    'question' => 'For the reaction, 2SO&lt;sub&gt;2&lt;/sub&gt; (g) + O&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2SO&lt;sub&gt;3&lt;/sub&gt; (g) the concentrations at equilibrium are &lt;br /&gt; [SO&lt;sub&gt;2&lt;/sub&gt; ] = 0.90 M, [O&lt;sub&gt;2&lt;/sub&gt; ] = 0.35 M, and [SO&lt;sub&gt;3&lt;/sub&gt; ] = 1.1 M. What is the value of the equilibrium constant, &lt;i&gt;K&lt;sub&gt;c&lt;/sub&gt; &lt;/i&gt; ?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-30 21:55:39',
    'updated_at' => '2023-05-30 21:55:39',
  ),
  145 => 
  array (
    'id' => 151,
    'exam_id' => 1,
    'question' => 'One of the following is considered to be part of environmental problems in Nigeria<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-05-31 11:35:12',
    'updated_at' => '2023-05-31 11:35:12',
  ),
  146 => 
  array (
    'id' => 152,
    'exam_id' => 8,
    'question' => 'One of the following is considered to be part of environmental problems in Nigeria<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 20:57:19',
    'updated_at' => '2023-06-03 20:57:19',
  ),
  147 => 
  array (
    'id' => 153,
    'exam_id' => 8,
    'question' => 'All the following are environmental problems except on<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 20:58:37',
    'updated_at' => '2023-06-03 20:58:37',
  ),
  148 => 
  array (
    'id' => 154,
    'exam_id' => 8,
    'question' => 'The greatest threats of the forest in Nigeria have been<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:01:02',
    'updated_at' => '2023-06-03 21:01:02',
  ),
  149 => 
  array (
    'id' => 155,
    'exam_id' => 8,
    'question' => 'A peoples� perception of the world is as result of their<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:02:17',
    'updated_at' => '2023-06-03 21:02:17',
  ),
  150 => 
  array (
    'id' => 156,
    'exam_id' => 8,
    'question' => '<div>Various ideas are put together to give us a picture of Nigerians perception of ____</div><div><br></div>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:03:19',
    'updated_at' => '2023-06-03 21:03:19',
  ),
  151 => 
  array (
    'id' => 157,
    'exam_id' => 8,
    'question' => 'In many Nigeria languages, the name given to God normally _____him as creator<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:07:05',
    'updated_at' => '2023-06-03 21:07:05',
  ),
  152 => 
  array (
    'id' => 158,
    'exam_id' => 8,
    'question' => 'Self-reliance according to August(_____) implies a decision by oneself<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:09:28',
    'updated_at' => '2023-06-03 21:09:28',
  ),
  153 => 
  array (
    'id' => 159,
    'exam_id' => 8,
    'question' => '<div>country is said to be self-reliance if the following criteria</div><div>is met except one</div>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:10:52',
    'updated_at' => '2023-06-03 21:10:52',
  ),
  154 => 
  array (
    'id' => 160,
    'exam_id' => 8,
    'question' => 'The following are characteristics features of self-reliance<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:12:08',
    'updated_at' => '2023-06-03 21:12:08',
  ),
  155 => 
  array (
    'id' => 161,
    'exam_id' => 8,
    'question' => 'The heavenly part is the home of the following except one<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:13:10',
    'updated_at' => '2023-06-03 21:13:10',
  ),
  156 => 
  array (
    'id' => 162,
    'exam_id' => 8,
    'question' => 'The unification of both northern and southern protectorates is called ___<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:14:41',
    'updated_at' => '2023-06-03 21:14:41',
  ),
  157 => 
  array (
    'id' => 163,
    'exam_id' => 8,
    'question' => '<div>The following clans can be located in the savannah zone of</div><div>Nigeria except one</div>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:16:19',
    'updated_at' => '2023-06-03 21:16:19',
  ),
  158 => 
  array (
    'id' => 164,
    'exam_id' => 8,
    'question' => 'What is cultural pattern?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:18:04',
    'updated_at' => '2023-06-03 21:18:04',
  ),
  159 => 
  array (
    'id' => 165,
    'exam_id' => 8,
    'question' => 'In your own opinion, do you think corruption is an important value in Nigeria society<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:19:01',
    'updated_at' => '2023-06-03 21:19:01',
  ),
  160 => 
  array (
    'id' => 166,
    'exam_id' => 8,
    'question' => 'Listed below are four components of culture except<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:22:08',
    'updated_at' => '2023-06-03 21:22:08',
  ),
  161 => 
  array (
    'id' => 167,
    'exam_id' => 8,
    'question' => 'Language determines perception and shape the world view of people<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:23:19',
    'updated_at' => '2023-06-03 21:23:19',
  ),
  162 => 
  array (
    'id' => 168,
    'exam_id' => 8,
    'question' => 'Language determines perception and shape the world view of people Of<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:24:55',
    'updated_at' => '2023-06-03 21:24:55',
  ),
  163 => 
  array (
    'id' => 169,
    'exam_id' => 8,
    'question' => '<div>Knowledge</div><div>_____is one of the Greek philosophers that preaches justice</div>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:25:46',
    'updated_at' => '2023-06-03 21:25:46',
  ),
  164 => 
  array (
    'id' => 170,
    'exam_id' => 8,
    'question' => 'The following ethnic group can be traced to the forest zone except one<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:26:54',
    'updated_at' => '2023-06-03 21:26:54',
  ),
  165 => 
  array (
    'id' => 171,
    'exam_id' => 8,
    'question' => 'General Yakubu Gowom (Rt) created ____ states in Nigeria<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:27:50',
    'updated_at' => '2023-06-03 21:27:50',
  ),
  166 => 
  array (
    'id' => 172,
    'exam_id' => 8,
    'question' => 'No culture is superior to the other since each is adapted to its own<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:29:17',
    'updated_at' => '2023-06-03 21:29:17',
  ),
  167 => 
  array (
    'id' => 173,
    'exam_id' => 8,
    'question' => 'Culture is a system of knowledge more or less shared by the member of a __<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:30:22',
    'updated_at' => '2023-06-03 21:30:22',
  ),
  168 => 
  array (
    'id' => 174,
    'exam_id' => 8,
    'question' => 'Nok culture is so far the oldest iron working in ____<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:34:38',
    'updated_at' => '2023-06-03 21:34:38',
  ),
  169 => 
  array (
    'id' => 175,
    'exam_id' => 8,
    'question' => '&nbsp;<span style="color: rgb(33, 37, 41); font-size: 1rem; -webkit-tap-highlight-color: transparent; -webkit-text-size-adjust: 100%;">In the year _____ an object (Roped pot on a sand) was</span><div>unearthened by one Isiah Anozie in a village called Igbo-Ukwu</div>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:36:01',
    'updated_at' => '2023-06-03 21:36:01',
  ),
  170 => 
  array (
    'id' => 176,
    'exam_id' => 8,
    'question' => 'All sort of abstraction design were made use of by the artist as the ornamentation of the surface. This statement is accredited to____<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:37:30',
    'updated_at' => '2023-06-03 21:37:30',
  ),
  171 => 
  array (
    'id' => 177,
    'exam_id' => 8,
    'question' => 'One of the characteristics of ____culture is that attention was not paid to human figure<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:38:30',
    'updated_at' => '2023-06-03 21:38:30',
  ),
  172 => 
  array (
    'id' => 178,
    'exam_id' => 8,
    'question' => 'Archaeological excavation with the prove of radiocarbon dating support the fact that the ancient city of Ille- Ife&nbsp;had been in existence before<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:40:35',
    'updated_at' => '2023-06-03 21:40:35',
  ),
  173 => 
  array (
    'id' => 179,
    'exam_id' => 8,
    'question' => 'One of the function of culture is procreation. What is procreation?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:42:58',
    'updated_at' => '2023-06-03 21:42:58',
  ),
  174 => 
  array (
    'id' => 180,
    'exam_id' => 8,
    'question' => 'Ife art came into limelight when a German Ethnologist, Leo Frobenius in ____excavated a good number of artifact<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:44:14',
    'updated_at' => '2023-06-03 21:44:14',
  ),
  175 => 
  array (
    'id' => 181,
    'exam_id' => 8,
    'question' => '<div>Historical, ethnological and archaeological accounts of the ancient city of Ille-Ife showed that there was an</div><div>organized kingdom with substantial urban settlement with evidence of ____industries</div>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:45:08',
    'updated_at' => '2023-06-03 21:45:08',
  ),
  176 => 
  array (
    'id' => 182,
    'exam_id' => 8,
    'question' => 'Culture is not genetically transmitted but rather it is ____<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:46:07',
    'updated_at' => '2023-06-03 21:46:07',
  ),
  177 => 
  array (
    'id' => 183,
    'exam_id' => 8,
    'question' => 'Culture changes in response to ___ needs and to ecological demands as evidence in the manner of dresses, hairstyle and pattern of behaviour of the people<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:47:31',
    'updated_at' => '2023-06-03 21:47:31',
  ),
  178 => 
  array (
    'id' => 184,
    'exam_id' => 8,
    'question' => 'What is Ethnocentrism?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:49:09',
    'updated_at' => '2023-06-03 21:49:09',
  ),
  179 => 
  array (
    'id' => 185,
    'exam_id' => 8,
    'question' => 'Nok terracotta pieces was found deep in alluvial deposit&nbsp;accidentally through the activities of the Tin miners in<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:50:19',
    'updated_at' => '2023-06-03 21:50:19',
  ),
  180 => 
  array (
    'id' => 186,
    'exam_id' => 8,
    'question' => 'The method in which the Nok sculptures were produced is commonly referred too as<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:51:25',
    'updated_at' => '2023-06-03 21:51:25',
  ),
  181 => 
  array (
    'id' => 187,
    'exam_id' => 8,
    'question' => 'The phonecians were noted sea traders and manufactures<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:52:43',
    'updated_at' => '2023-06-03 21:52:43',
  ),
  182 => 
  array (
    'id' => 188,
    'exam_id' => 8,
    'question' => 'Double coincidence of wants means____<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:54:17',
    'updated_at' => '2023-06-03 21:54:17',
  ),
  183 => 
  array (
    'id' => 189,
    'exam_id' => 8,
    'question' => 'African culture exchange grains and other agricultural products such as the following except one<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:55:04',
    'updated_at' => '2023-06-03 21:55:04',
  ),
  184 => 
  array (
    'id' => 190,
    'exam_id' => 8,
    'question' => 'Listed below are factors that militate against the attainment of self-reliance except one<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:56:44',
    'updated_at' => '2023-06-03 21:56:44',
  ),
  185 => 
  array (
    'id' => 191,
    'exam_id' => 8,
    'question' => 'Moral obligation of citizens according to Johnson (1988) is the standards of behaviour and duties which is perform by____<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:57:43',
    'updated_at' => '2023-06-03 21:57:43',
  ),
  186 => 
  array (
    'id' => 192,
    'exam_id' => 8,
    'question' => 'Most ethnic group in Nigeria were politically organized into empires and kingdom independent of one another. Listed below are some of the group except One<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 21:59:05',
    'updated_at' => '2023-06-03 21:59:05',
  ),
  187 => 
  array (
    'id' => 193,
    'exam_id' => 8,
    'question' => 'The Hausa Fulani were noted ----- in the pre-colonial period<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 22:02:18',
    'updated_at' => '2023-06-03 22:02:18',
  ),
  188 => 
  array (
    'id' => 194,
    'exam_id' => 8,
    'question' => 'The Yoruba people lived in large town under the leadership of ____<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 22:03:08',
    'updated_at' => '2023-06-03 22:03:08',
  ),
  189 => 
  array (
    'id' => 195,
    'exam_id' => 8,
    'question' => 'Power is not ____distributed in Nigeria<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 22:04:30',
    'updated_at' => '2023-06-03 22:04:30',
  ),
  190 => 
  array (
    'id' => 196,
    'exam_id' => 8,
    'question' => 'The largest community that had not central authority before 1800 was the __<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 22:05:31',
    'updated_at' => '2023-06-03 22:05:31',
  ),
  191 => 
  array (
    'id' => 197,
    'exam_id' => 8,
    'question' => 'What right does the Nigeria constitution recognizes?<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 22:06:31',
    'updated_at' => '2023-06-03 22:06:31',
  ),
  192 => 
  array (
    'id' => 198,
    'exam_id' => 8,
    'question' => 'Trade by barter was the earliest form of____<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 22:07:53',
    'updated_at' => '2023-06-03 22:07:53',
  ),
  193 => 
  array (
    'id' => 199,
    'exam_id' => 8,
    'question' => 'The problem of barter led to the discovery of items that was regarded as currency such as the following Except&nbsp;<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 22:10:34',
    'updated_at' => '2023-06-03 22:10:34',
  ),
  194 => 
  array (
    'id' => 200,
    'exam_id' => 8,
    'question' => 'Which part of Nigeria resisted conquest<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 22:12:39',
    'updated_at' => '2023-06-03 22:12:39',
  ),
  195 => 
  array (
    'id' => 201,
    'exam_id' => 8,
    'question' => 'Nigeria maintains a parallel system of traditional governance whichinclude_____<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 22:13:58',
    'updated_at' => '2023-06-03 22:13:58',
  ),
  196 => 
  array (
    'id' => 202,
    'exam_id' => 8,
    'question' => 'Social justice is a condition where ____ exist<br>',
    'marks' => 1.2,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-06-03 22:16:26',
    'updated_at' => '2023-06-03 22:16:26',
  ),
  197 => 
  array (
    'id' => 204,
    'exam_id' => 10,
    'question' => '<span style="font-size:11.0pt;line-height:115%;
font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
mso-bidi-language:AR-SA">In the early 19th century, the discovery of what
substance was a turning point in the debate between vitalism and mechanism in
organic chemistry?</span><br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 06:48:41',
    'updated_at' => '2023-11-08 06:48:41',
  ),
  198 => 
  array (
    'id' => 206,
    'exam_id' => 10,
    'question' => '<span style="font-size:11.0pt;line-height:115%;
font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
mso-bidi-language:AR-SA">What is the name of the chemical process discovered by
Friedrich Wöhler in 1828 that demonstrated the synthesis of urea from inorganic
materials, disproving the theory of vitalism?</span><br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 06:50:18',
    'updated_at' => '2023-11-08 06:50:18',
  ),
  199 => 
  array (
    'id' => 208,
    'exam_id' => 10,
    'question' => '<p class="MsoNormal">What is the name of the reaction that converts alkenes or
alkynes into alkanes by the addition of hydrogen in the presence of a catalyst,
a fundamental process in organic chemistry?<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 06:51:45',
    'updated_at' => '2023-11-08 06:51:45',
  ),
  200 => 
  array (
    'id' => 209,
    'exam_id' => 10,
    'question' => '<span style="font-size:11.0pt;line-height:115%;
font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
mso-bidi-language:AR-SA">Who was the first woman to win a Nobel Prize and the
only person to win Nobel Prizes in two different scientific fields, including
one in chemistry for her work on radioactivity and the discovery of radium and
polonium?</span><br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 06:52:44',
    'updated_at' => '2023-11-08 06:52:44',
  ),
  201 => 
  array (
    'id' => 210,
    'exam_id' => 10,
    'question' => '<span style="font-size:11.0pt;line-height:115%;
font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
mso-bidi-language:AR-SA">In the context of organic chemistry, what is the IUPAC
name for the compound CH3-CH2-CH2-CHO?</span><br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 06:53:22',
    'updated_at' => '2023-11-08 06:53:22',
  ),
  202 => 
  array (
    'id' => 213,
    'exam_id' => 10,
    'question' => '<span style="font-size:11.0pt;line-height:115%;
font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
mso-bidi-language:AR-SA">Which organic compound is commonly known as "wood
alcohol"?</span><br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 06:55:48',
    'updated_at' => '2023-11-08 06:55:48',
  ),
  203 => 
  array (
    'id' => 214,
    'exam_id' => 10,
    'question' => '<span style="font-size:11.0pt;line-height:115%;
font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
mso-bidi-language:AR-SA">Who is known for the discovery of the first
antibiotic, penicillin, which revolutionized medicine and had a significant
impact on organic chemistry?</span><br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 06:56:43',
    'updated_at' => '2023-11-08 06:56:43',
  ),
  204 => 
  array (
    'id' => 215,
    'exam_id' => 10,
    'question' => '<span style="font-size:11.0pt;line-height:115%;
font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
mso-bidi-language:AR-SA">Which organic molecule is the primary structural
component of the cell membrane and plays a crucial role in cell biology and
biochemistry?</span><br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 06:57:31',
    'updated_at' => '2023-11-08 06:57:31',
  ),
  205 => 
  array (
    'id' => 217,
    'exam_id' => 10,
    'question' => '<p class="MsoNormal">Who is the American chemist famous for his research on
synthetic polymers and the invention of nylon, a significant development in the
field of organic chemistry?<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 06:59:04',
    'updated_at' => '2023-11-08 06:59:04',
  ),
  206 => 
  array (
    'id' => 221,
    'exam_id' => 10,
    'question' => '<p class="MsoNormal">Which Nobel laureate in chemistry is known for his work on
the synthesis of complex natural products and the discovery of the structure of
DNA, alongside Francis Crick and Rosalind Franklin?<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 07:01:41',
    'updated_at' => '2023-11-08 07:01:41',
  ),
  207 => 
  array (
    'id' => 223,
    'exam_id' => 10,
    'question' => '<span style="font-size:11.0pt;line-height:115%;
font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
mso-bidi-language:AR-SA">Who was the chemist responsible for isolating and
characterizing the element fluorine and making significant contributions to the
field of organofluorine chemistry?</span><br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 07:03:09',
    'updated_at' => '2023-11-08 07:03:09',
  ),
  208 => 
  array (
    'id' => 227,
    'exam_id' => 10,
    'question' => '<p class="MsoNormal">Who is known for the discovery of the structure of DNA and
is famous for the double helix model, a fundamental contribution to the
understanding of genetics and biochemistry?<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 07:06:09',
    'updated_at' => '2023-11-08 07:06:09',
  ),
  209 => 
  array (
    'id' => 228,
    'exam_id' => 10,
    'question' => '<p class="MsoNormal">What is the name of the reaction that converts an ester and
an alcohol into a carboxylic acid and another alcohol, often used in the
synthesis of soap?<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 07:07:03',
    'updated_at' => '2023-11-08 07:07:03',
  ),
  210 => 
  array (
    'id' => 229,
    'exam_id' => 10,
    'question' => '<p class="MsoNormal">Who is the American chemist known for his contributions to
the development of metathesis reactions, which have important applications in
the synthesis of complex organic molecules?<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 07:07:41',
    'updated_at' => '2023-11-08 07:07:41',
  ),
  211 => 
  array (
    'id' => 230,
    'exam_id' => 10,
    'question' => '<span style="font-size:11.0pt;line-height:115%;
font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
mso-bidi-language:AR-SA">What is the name of the reaction that converts an
alcohol into an alkene by the removal of water, often used in the production of
ethylene?</span><br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-08 07:08:36',
    'updated_at' => '2023-11-08 07:08:36',
  ),
  212 => 
  array (
    'id' => 233,
    'exam_id' => 11,
    'question' => 'What will be the resultant force on a body
of mass 50 kg when it moves with a
uniform velocity of 10 m/s?<br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 05:51:19',
    'updated_at' => '2023-11-09 05:51:19',
  ),
  213 => 
  array (
    'id' => 235,
    'exam_id' => 11,
    'question' => 'A riffle bullet weighing 7 g leaves the
barrel of riffle with a velocity of 300 m/s. If
the riffle recoils with a velocity of 1 m/s,
find the mass of the riffle.<br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 15:14:53',
    'updated_at' => '2023-11-09 15:14:53',
  ),
  214 => 
  array (
    'id' => 236,
    'exam_id' => 11,
    'question' => 'Determine the dimension of density.<br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 15:30:18',
    'updated_at' => '2023-11-09 15:30:18',
  ),
  215 => 
  array (
    'id' => 237,
    'exam_id' => 11,
    'question' => 'Which of the following is not a possible unit
for velocity?&nbsp;<br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 15:56:00',
    'updated_at' => '2023-11-09 15:56:00',
  ),
  216 => 
  array (
    'id' => 238,
    'exam_id' => 11,
    'question' => 'Which of the Newton’s law state that, “when a
body is acted upon by a force, its resulting
acceleration is directly proportional to the
force and inversely proportional to the
mass”?<br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 16:00:07',
    'updated_at' => '2023-11-09 16:00:07',
  ),
  217 => 
  array (
    'id' => 239,
    'exam_id' => 11,
    'question' => 'The force acting on a body moving with a
uniform velocity is<br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 16:03:03',
    'updated_at' => '2023-11-09 16:03:03',
  ),
  218 => 
  array (
    'id' => 241,
    'exam_id' => 11,
    'question' => '. Which of the following units cannot be used
to measure speed?<br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 16:11:21',
    'updated_at' => '2023-11-09 16:11:21',
  ),
  219 => 
  array (
    'id' => 242,
    'exam_id' => 11,
    'question' => 'The acceleration of a body falling under
gravity on the surface of the earth is&nbsp;<br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 16:14:06',
    'updated_at' => '2023-11-09 16:14:06',
  ),
  220 => 
  array (
    'id' => 244,
    'exam_id' => 11,
    'question' => 'A car moves from rest with an acceleration
of 0.2 m/s2. Find its velocity when it has
moved a distance of 50 m.<br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 16:18:38',
    'updated_at' => '2023-11-09 16:18:38',
  ),
  221 => 
  array (
    'id' => 245,
    'exam_id' => 11,
    'question' => 'A ball is released from a height of 20 m.
Calculate the velocity with which it hits the
ground<br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 16:24:05',
    'updated_at' => '2023-11-09 16:24:05',
  ),
  222 => 
  array (
    'id' => 246,
    'exam_id' => 11,
    'question' => 'A body moving with a constant velocity
along a straight line PQR takes 30 s to go
from P to Q and 10 s to go from Q to R. If
PR = 4 m, Find PQ.&nbsp;<br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 16:25:24',
    'updated_at' => '2023-11-09 16:25:24',
  ),
  223 => 
  array (
    'id' => 247,
    'exam_id' => 11,
    'question' => 'A motor car is uniformly retarded and
brought to rest from a velocity 36 km/h in
5 s. Find the distance covered during this
period.<br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 16:26:49',
    'updated_at' => '2023-11-09 16:26:49',
  ),
  224 => 
  array (
    'id' => 249,
    'exam_id' => 11,
    'question' => 'The thermometric property of a thermocouple&nbsp;is the change in _______. <br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 16:44:49',
    'updated_at' => '2023-11-09 16:44:49',
  ),
  225 => 
  array (
    'id' => 250,
    'exam_id' => 11,
    'question' => 'The difference observed in solids, liquids and
gas may be accounted for by&nbsp; &nbsp;<br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 16:52:56',
    'updated_at' => '2023-11-09 16:52:56',
  ),
  226 => 
  array (
    'id' => 252,
    'exam_id' => 11,
    'question' => 'The relationship between volume and
pressure is investigated when temperature
and amount of gas are kept constant is
known as&nbsp;<br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-09 16:55:45',
    'updated_at' => '2023-11-09 16:55:45',
  ),
  227 => 
  array (
    'id' => 255,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal"><span style="mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;
mso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;">&nbsp;Choose the option&nbsp;nearest in meaning&nbsp;to the underlined statement or words:</span><span style="mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;
mso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;"><o:p></o:p></span></p><p class="MsoNormal"><span style="mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;
mso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;">Had she asked me earlier, i might have been able to employ him</span><span style="mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;
mso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;"><o:p></o:p></span></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:20:36',
    'updated_at' => '2023-11-10 15:20:36',
  ),
  228 => 
  array (
    'id' => 256,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal"><span style="mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;
mso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;">Choose the option&nbsp;nearest in meaning&nbsp;to the underlined statement or words:</span><span style="mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;
mso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;"><o:p></o:p></span></p><p class="MsoNormal"><span style="mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;
mso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;">If he were to apologize i would probably forgive him</span></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:22:22',
    'updated_at' => '2023-11-10 15:22:22',
  ),
  229 => 
  array (
    'id' => 257,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal">Choose the option&nbsp;nearest in meaning&nbsp;to the
underlined words :<o:p></o:p></p>

<p class="MsoNormal"><o:p>&nbsp;</o:p></p>

<p class="MsoNormal">As he was a gullible leader his followers took advantage of
him<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:24:37',
    'updated_at' => '2023-11-10 15:24:37',
  ),
  230 => 
  array (
    'id' => 258,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal">&nbsp;Choose the
option&nbsp;nearest in meaning&nbsp;to the underlined words :<o:p></o:p></p>

<p class="MsoNormal">His summary of the meeting was&nbsp;BRIEF AND TO THE POINT.<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:26:00',
    'updated_at' => '2023-11-10 15:26:00',
  ),
  231 => 
  array (
    'id' => 259,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal">&nbsp;Choose the
option&nbsp;nearest in meaning&nbsp;to the underlined words :<o:p></o:p></p>

<p class="MsoNormal">Do you have the same&nbsp;AVERSION&nbsp;as i do for way
film?<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:27:26',
    'updated_at' => '2023-11-10 15:27:26',
  ),
  232 => 
  array (
    'id' => 260,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal">&nbsp;Choose the
option&nbsp;nearest in meaning&nbsp;to the underlined words :<o:p></o:p></p>

<p class="MsoNormal">I didn\'t think she could be so easily&nbsp;TAKEN IN by his
pretences<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:29:22',
    'updated_at' => '2023-11-10 15:29:22',
  ),
  233 => 
  array (
    'id' => 261,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal">&nbsp;Choose the
option&nbsp;nearest in meaning&nbsp;to the underlined words :<o:p></o:p></p>

<p class="MsoNormal">The&nbsp;CRUX OF THE MATTER&nbsp;is that the president has
just become aware of the mismanagement<o:p></o:p></p>

<p class="MsoNormal"><o:p>&nbsp;</o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:30:57',
    'updated_at' => '2023-11-10 15:30:57',
  ),
  234 => 
  array (
    'id' => 262,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal">&nbsp;Fill in the blank
spaces in the following sentences making use of the best of the five options<o:p></o:p></p>

<p class="MsoNormal">Olukayode .... as a mechanic when he was young, but now he
is a driver<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:32:16',
    'updated_at' => '2023-11-10 15:32:16',
  ),
  235 => 
  array (
    'id' => 263,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal">Choose the option that best conveys the meaning of the
underlined portion in the following sentence;<o:p></o:p></p>

<p class="MsoNormal"><o:p>&nbsp;</o:p></p>

<p class="MsoNormal">From the ways my friend talks, you can see he is such&nbsp;A
BORE<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:34:38',
    'updated_at' => '2023-11-10 15:34:38',
  ),
  236 => 
  array (
    'id' => 264,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal">Choose the option that best conveys the meaning of the
underlined portion in the following sentence;<o:p></o:p></p><p class="MsoNormal"><o:p>&nbsp;</o:p></p><p class="MsoNormal">

</p><p class="MsoNormal">The&nbsp;LEADER&nbsp;in today\'s issue of our popular
newspaper focuses on inflation<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:36:24',
    'updated_at' => '2023-11-10 15:36:24',
  ),
  237 => 
  array (
    'id' => 265,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal">Choose the option that best conveys the meaning of the
underlined portion in the following sentence;<o:p></o:p></p>

<p class="MsoNormal"><o:p>&nbsp;</o:p></p>

<p class="MsoNormal">He spoke with HIS HEART IN HIS MOUTH<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:38:03',
    'updated_at' => '2023-11-10 15:38:03',
  ),
  238 => 
  array (
    'id' => 266,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal">Choose the option that best conveys the meaning of the
underlined portion in the following sentence;<o:p></o:p></p>

<p class="MsoNormal"><o:p>&nbsp;</o:p></p>

<p class="MsoNormal">When the man was caught by police he&nbsp;presented a bold
front<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:39:11',
    'updated_at' => '2023-11-10 15:39:11',
  ),
  239 => 
  array (
    'id' => 267,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal">Complete each of the following sentences by choosing the
option that&nbsp;most suitably&nbsp;fills the space;<o:p></o:p></p>

<p class="MsoNormal"><o:p>&nbsp;</o:p></p>

<p class="MsoNormal">When the beggar was tired he ..... down by the roadside<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:40:36',
    'updated_at' => '2023-11-10 15:40:36',
  ),
  240 => 
  array (
    'id' => 268,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal">Complete each of the following sentences by choosing the
option that&nbsp;most suitably&nbsp;fills the space;<o:p></o:p></p>

<p class="MsoNormal">He did not like .... leaving the class early<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:42:05',
    'updated_at' => '2023-11-10 15:42:05',
  ),
  241 => 
  array (
    'id' => 269,
    'exam_id' => 13,
    'question' => '<p class="MsoNormal">Complete each of the following sentences by choosing the
option that&nbsp;most suitably&nbsp;fills the space;<o:p></o:p></p>

<p class="MsoNormal"><o:p>&nbsp;</o:p></p>

<p class="MsoNormal">Before the operation, the dentist found that his patient\'s
teeth....<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-10 15:43:26',
    'updated_at' => '2023-11-10 15:43:26',
  ),
  242 => 
  array (
    'id' => 271,
    'exam_id' => 14,
    'question' => '<p class="MsoNormal">If y = (1 + x)² find&nbsp;dydx<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 04:23:49',
    'updated_at' => '2023-11-11 04:23:49',
  ),
  243 => 
  array (
    'id' => 272,
    'exam_id' => 14,
    'question' => '<p class="MsoNormal">If y = 3 cos 4x, dy/dx equals<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 04:25:04',
    'updated_at' => '2023-11-11 04:25:04',
  ),
  244 => 
  array (
    'id' => 273,
    'exam_id' => 14,
    'question' => '<p class="MsoNormal">If y = (2x + 1)³&nbsp; find
dy/dx<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 04:26:29',
    'updated_at' => '2023-11-11 04:26:29',
  ),
  245 => 
  array (
    'id' => 274,
    'exam_id' => 14,
    'question' => '<p class="MsoNormal">&nbsp;If y = 3 sin 4x,
dy/dx equals<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 04:27:38',
    'updated_at' => '2023-11-11 04:27:38',
  ),
  246 => 
  array (
    'id' => 275,
    'exam_id' => 14,
    'question' => '<p class="MsoNormal">Find the derivative of&nbsp;sinθcosθsin⁡θcos⁡θ<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 04:28:43',
    'updated_at' => '2023-11-11 04:28:43',
  ),
  247 => 
  array (
    'id' => 276,
    'exam_id' => 14,
    'question' => '<p class="MsoNormal">&nbsp;If y = x²-&nbsp;1x, find&nbsp;dy/dx<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 04:29:45',
    'updated_at' => '2023-11-11 04:29:45',
  ),
  248 => 
  array (
    'id' => 277,
    'exam_id' => 14,
    'question' => '<p class="MsoNormal">&nbsp;If y = 4x³&nbsp;-
2x²&nbsp;+ x, find&nbsp;δyδx<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 04:30:57',
    'updated_at' => '2023-11-11 04:30:57',
  ),
  249 => 
  array (
    'id' => 278,
    'exam_id' => 14,
    'question' => '<p class="MsoNormal">If &nbsp;y = cos 3x, find&nbsp;δyδx1<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 04:32:30',
    'updated_at' => '2023-11-11 04:32:30',
  ),
  250 => 
  array (
    'id' => 279,
    'exam_id' => 14,
    'question' => '<p class="MsoNormal">Find the derivative of y = (&nbsp;13X + 6)²<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 04:33:30',
    'updated_at' => '2023-11-11 04:33:30',
  ),
  251 => 
  array (
    'id' => 280,
    'exam_id' => 14,
    'question' => '<p class="MsoNormal">&nbsp;Integrate&nbsp;∫(4x−³−7x²+5x−6)dx.<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 04:34:33',
    'updated_at' => '2023-11-11 04:34:33',
  ),
  252 => 
  array (
    'id' => 281,
    'exam_id' => 14,
    'question' => '<p class="MsoNormal">&nbsp;Integrate the
expression 6x²&nbsp;- 2x + 1<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 04:35:36',
    'updated_at' => '2023-11-11 04:35:36',
  ),
  253 => 
  array (
    'id' => 282,
    'exam_id' => 14,
    'question' => '<p class="MsoNormal">&nbsp;Integrate&nbsp;2x³–2x² with respect to x<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 04:36:49',
    'updated_at' => '2023-11-11 04:36:49',
  ),
  254 => 
  array (
    'id' => 283,
    'exam_id' => 14,
    'question' => '<p class="MsoNormal">Evaluate&nbsp;∫(cos4x + sin3x)dx<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 04:37:42',
    'updated_at' => '2023-11-11 04:37:42',
  ),
  255 => 
  array (
    'id' => 284,
    'exam_id' => 14,
    'question' => '<p class="MsoNormal">&nbsp;If y = x sinx,
find&nbsp;dydx<o:p></o:p></p>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 04:38:53',
    'updated_at' => '2023-11-11 04:38:53',
  ),
  256 => 
  array (
    'id' => 285,
    'exam_id' => 14,
    'question' => '<span style="font-size:11.0pt;line-height:115%;
font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
&quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
mso-bidi-language:AR-SA">If y = 3 sin 4x, dy/dx equals</span><br>',
    'marks' => 1.0,
    'written_ans' => NULL,
    'status' => 0,
    'created_at' => '2023-11-11 12:56:24',
    'updated_at' => '2023-11-11 12:56:24',
  ),
));
    }
}
