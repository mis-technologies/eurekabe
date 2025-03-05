<?php

namespace Modules\Exam\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Exam\Models\Question;
use Modules\Exam\Models\QuestionOption;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $questions = [

            // Physics
            [
                'exam_id' => 1,
                'question' => 'The temperature 45oC is the same as<br>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '49oF', 'is_correct' => false],
                    ['option' => '318oF', 'is_correct' => false],
                    ['option' => '160oF', 'is_correct' => false],
                    ['option' => '113oF', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>The thermometric property of a thermocouple </div><div>is the change in _______. </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'Equivalent resistance', 'is_correct' => false],
                    ['option' => 'Electromotive force', 'is_correct' => false],
                    ['option' => 'Current', 'is_correct' => true],
                    ['option' => 'Pressure', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>A thermometer with an arbitrary scale Y </div><div>registers -50oY at the lower fixed point and </div><div>+70oY at the upper fixed point. The Celsius </div><div>temperature corresponding to 30oY is </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '42.9oC', 'is_correct' => false],
                    ['option' => '50.0oC', 'is_correct' => false],
                    ['option' => '66.7oC', 'is_correct' => true],
                    ['option' => '75.0oC', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>The heat required to raise the temperature of </div><div>one mole of a gas by 1K is </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'Specific heat capacity', 'is_correct' => false],
                    ['option' => 'Thermal heat capacity', 'is_correct' => false],
                    ['option' => 'Molar heat capacity', 'is_correct' => true],
                    ['option' => 'Heat capacity', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => 'Fahrenheit and Celsius readings are the same<br>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'At 0o in either scale', 'is_correct' => false],
                    ['option' => 'At 40o in either scale', 'is_correct' => false],
                    ['option' => 'At -40o in either scal', 'is_correct' => true],
                    ['option' => 'At 100o in either scale', 'is_correct' => false],
                    ['option' => 'At -10o in either scale', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>At what temperature is the Fahrenheit scale </div><div>twice the Centigrade scale? </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '-40oF', 'is_correct' => false],
                    ['option' => '320oC', 'is_correct' => false],
                    ['option' => '160oF', 'is_correct' => false],
                    ['option' => '160oC', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>Calculate the Celsius scale equivalent of a </div><div>temperature of 300K room temperature</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '20oC', 'is_correct' => false],
                    ['option' => '300oC', 'is_correct' => false],
                    ['option' => '27oC', 'is_correct' => true],
                    ['option' => '30oC', 'is_correct' => false],
                    ['option' => '54oC', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => 'Hot water is added to three times the mass of
                        <div>water at 100C and the resulting temperature
                        </div><div>is 200C. What is the initial temperature of the
                        </div><div>hot water? </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '1000C', 'is_correct' => false],
                    ['option' => '500C', 'is_correct' => true],
                    ['option' => '800C', 'is_correct' => false],
                    ['option' => '400C', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => 'Specific heat is defined in term of;<br>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'Degrees Celsius per kilogram', 'is_correct' => false],
                    ['option' => 'Calories per kilogram', 'is_correct' => false],
                    ['option' => 'Grams per degree calories', 'is_correct' => false],
                    ['option' => 'Calories per gram per degree Celsius', 'is_correct' => true],
                    ['option' => 'Degree Celsius per gram calorie', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>A body mass 120g and specific heat capacity </div><div>of 400Jkg-1K-1 losses 240J of heat energy. The </div><div>change in temperature of the body is </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '5.0k', 'is_correct' => true],
                    ['option' => '4.5k', 'is_correct' => false],
                    ['option' => '2.0k', 'is_correct' => false],
                    ['option' => '0.5k', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>The specific heat capacity of water is 4.2Jg-1K￾1 and the specific latent heat of vapourisation </div><div>of water is 2260Jg-1. The heat required to </div><div>vapourise 200g water initially at 80oC is </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '16kJ', 'is_correct' => false],
                    ['option' => '452.0kJ', 'is_correct' => false],
                    ['option' => '468.8kJ', 'is_correct' => true],
                    ['option' => '937.6kJ', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>A metal of volume 40cm3 and linear </div><div>expansivity 1.94 × 10−5</div><div>is heated from 300C </div><div>to 900C, the increase in volume is </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '1.2 cm3', 'is_correct' => false],
                    ['option' => '0.40 cm3', 'is_correct' => false],
                    ['option' => '0.14cm3', 'is_correct' => true],
                    ['option' => '4.0cm3', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => 'A wire of length 5m is heated from a
                        <div>temperature of 10oC to 60oC. If it undergoes a
                        </div><div>change of length of 20mm, the linear
                        </div><div>expansivity of the wire is </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '8 x 10-4K-1', 'is_correct' => false],
                    ['option' => '4 x 10-4K-1', 'is_correct' => false],
                    ['option' => '8 x 10-5K-1', 'is_correct' => true],
                    ['option' => '4 x 10-5K-1', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>A telegraph wire of length 100.0m at 30oC </div><div>has linear expansivity of 2 x 10-5K-1. The </div><div>length of the wire at a temperature of -10oC is</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '100.08m', 'is_correct' => false],
                    ['option' => '100.04m', 'is_correct' => false],
                    ['option' => '99.96m', 'is_correct' => false],
                    ['option' => '99.92m', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => 'In NaCl, Na ions are positively charged and
                        <div>chlorine ions are negatively charged. Despite
                        </div><div>the coulomb’s attraction between them, why
                        </div><div>do the two ions not collapse? </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'because of the presence of free electrons', 'is_correct' => false],
                    ['option' => 'because of its low melting point', 'is_correct' => false],
                    ['option' => 'because of its high specific heat', 'is_correct' => false],
                    ['option' => 'Because of short range repulsive force', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>The difference observed in solids, liquids and</div><div>gas may be accounted for by </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'the spacing and forces acting between the  molecules', 'is_correct' => false],
                    ['option' => 'their relative masses', 'is_correct' => false],
                    ['option' => 'the different molecules in each of them', 'is_correct' => true],
                    ['option' => 'their melting point', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>Two atoms are scrutinized. Their nuclei have </div><div>the same number of protons, but one nucleus</div><div>has two neutrons more than the other, these </div><div>atoms represent;</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'The same element and the same isotope', 'is_correct' => false],
                    ['option' => 'Different element and the same isotope', 'is_correct' => false],
                    ['option' => 'The same element and different isotope', 'is_correct' => true],
                    ['option' => 'Different element and different isotope', 'is_correct' => false],
                    ['option' => 'An impossible situation, this scenario cannot occur', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>Which of the following statements is correct </div><div>about evaporation and boiling </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'Evaporation occur at any temperature  while boiling takes place at a specific  temperature', 'is_correct' => true],
                    ['option' => 'Both are affected by wind', 'is_correct' => false],
                    ['option' => 'Evaporation occur in the entire body of the  liquid while boiling occur at the surface  exposed', 'is_correct' => false],
                    ['option' => 'Both evaporation and boiling causes  cooling', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>In the process of evaporation, a state of </div><div>affairs is reached at the surface of the liquid </div><div>in which molecules are arriving and </div><div>departing at the same rate is called? </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'state equilibrium', 'is_correct' => false],
                    ['option' => 'dynamic equilibrium', 'is_correct' => true],
                    ['option' => 'equilibrium', 'is_correct' => false],
                    ['option' => 'state affair equilibrium', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>The pressure of a constant volume gas </div><div>thermometer is 1500N/m2 at 280C. What will </div><div>be the temperature of the gas when the </div><div>pressure is increased by one-third</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '100k', 'is_correct' => false],
                    ['option' => '201k', 'is_correct' => false],
                    ['option' => '266k', 'is_correct' => false],
                    ['option' => '401k', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>The pressure of a constant volume gas </div><div>thermometer is 1500N/m2 at 280C. What will </div><div>be the temperature of the gas when the </div><div>pressure is increased by one-third</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '100k', 'is_correct' => false],
                    ['option' => '201k', 'is_correct' => false],
                    ['option' => '266k', 'is_correct' => false],
                    ['option' => '401k', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>Which of the following phenomena CANNOT</div><div>be explained by the molecular theory of </div><div>matter? </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'Expansion', 'is_correct' => false],
                    ['option' => 'Evaporation', 'is_correct' => true],
                    ['option' => 'Radiation', 'is_correct' => false],
                    ['option' => 'Conduction', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>When two bodies are in thermal contact and </div><div>there is no net transfer of heat the bodies are </div><div>said to be in </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'thermal equilibrium', 'is_correct' => true],
                    ['option' => 'contact equilibrium', 'is_correct' => false],
                    ['option' => 'transfer equilibrium', 'is_correct' => false],
                    ['option' => 'adiabatic equilibrium', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>What is the average speed of oxygen gas </div><div>molecules at T= 300K </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '45 m/s', 'is_correct' => false],
                    ['option' => '54 m/s', 'is_correct' => false],
                    ['option' => '445 m/s', 'is_correct' => true],
                    ['option' => '545 m/s', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>The energy in a system, whether transferred </div><div>to it as heat or work is called </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'external energy', 'is_correct' => false],
                    ['option' => 'system energy', 'is_correct' => false],
                    ['option' => 'internal energy', 'is_correct' => true],
                    ['option' => 'work energy', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>Calculate the work done by 1 mole of an ideal </div><div>gas that is kept at 0oC in an expansion from 3 </div><div>to10 liters.</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '2700j', 'is_correct' => true],
                    ['option' => '2400j', 'is_correct' => false],
                    ['option' => '1800j', 'is_correct' => false],
                    ['option' => '1500j', 'is_correct' => false],
                    ['option' => '1200j', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>Nine particles have speeds of 5, 8, 12, 12, 12, </div><div>14, 14, 17 and 10m/s. Find the root mean </div><div>square speed.</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '12.3m/s', 'is_correct' => false],
                    ['option' => '13.3m/s', 'is_correct' => false],
                    ['option' => '14.2m/s', 'is_correct' => false],
                    ['option' => '12.0m/s', 'is_correct' => true],
                    ['option' => '20.2m/s', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>The density of air of 0oC and at a pressure of </div><div>1.01 x 105N/m2is 1.29kg/m3. What is the </div><div>root mean square speed of its molecules?</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '584m/s', 'is_correct' => false],
                    ['option' => '485m/s', 'is_correct' => true],
                    ['option' => '358m/s', 'is_correct' => false],
                    ['option' => '254m/s', 'is_correct' => false],
                    ['option' => '1186m/s', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>A cubical container is filled with hydrogen </div><div>gas. The height and temperature of the </div><div>container are 2m and 0oC respectively. </div><div>Calculate the average translational kinetic </div><div>energy of a molecule </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '7.0 x 10-21', 'is_correct' => false],
                    ['option' => '6.6 x20-27', 'is_correct' => false],
                    ['option' => '5.7 x10-21', 'is_correct' => true],
                    ['option' => '4.6 x10-27', 'is_correct' => false],
                    ['option' => '3.7 x10-12', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>The deduction from the kinetic theory of </div><div>matter includes;</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'The mean free path hypothesis', 'is_correct' => false],
                    ['option' => 'Vander Waal’s law', 'is_correct' => false],
                    ['option' => 'The Zeroth’s law', 'is_correct' => true],
                    ['option' => 'Thermodynamics law', 'is_correct' => false],
                    ['option' => 'Avogadro’s law', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>Which of thefollowing in not a deduction </div><div>from the kinetic theory of matter</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'Avogadro’s law', 'is_correct' => false],
                    ['option' => 'Grahams’ law', 'is_correct' => false],
                    ['option' => 'Gay Lussac’s law', 'is_correct' => true],
                    ['option' => 'Dalton\'s law', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>What is the total random kinetic energy of </div><div>the molecules in one mole of a gas at a </div><div>temperature of 300K? </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '3740j', 'is_correct' => true],
                    ['option' => '6235j', 'is_correct' => false],
                    ['option' => '3402j', 'is_correct' => false],
                    ['option' => '7980j', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>What is the total random kinetic energy of </div><div>the molecules in one mole of a gas at a </div><div>temperature of 300K? </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '3740j', 'is_correct' => true],
                    ['option' => '6235j', 'is_correct' => false],
                    ['option' => '3402j', 'is_correct' => false],
                    ['option' => '7980j', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>What is the root mean square speed of a </div><div>hydrogen molecule at 300K?</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '1934m/s', 'is_correct' => true],
                    ['option' => '2719m/s', 'is_correct' => false],
                    ['option' => '2979m/s', 'is_correct' => false],
                    ['option' => '3256m/s', 'is_correct' => false],
                    ['option' => '4225m/s', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>The temperature at which the volume of a </div><div>(i) Absolutezero of temperature </div><div>(ii) Having a value of -273oC </div><div>gas become theoretically zero is </div><div>(iii) Zero point energy </div><div>(iv) All of the above</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'i only', 'is_correct' => false],
                    ['option' => 'ii only', 'is_correct' => false],
                    ['option' => 'iii only', 'is_correct' => false],
                    ['option' => 'iv only', 'is_correct' => true],
                    ['option' => 'None of the above', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>At what temperature is the root-mean</div><div>the rootmeansquare speed of hydrogen </div><div>square speed ofnitrogen molecules equal to </div><div>moleculesat 20oC </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '3800K', 'is_correct' => false],
                    ['option' => '1800K', 'is_correct' => false],
                    ['option' => '1800oC', 'is_correct' => false],
                    ['option' => '3800oC', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>For real gases the internal energy depends </div><div>on?</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'Volume', 'is_correct' => false],
                    ['option' => 'Temperature', 'is_correct' => true],
                    ['option' => 'Pressure', 'is_correct' => false],
                    ['option' => 'Volume and temperature', 'is_correct' => false],
                    ['option' => 'Pressure and temperature', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>The nature of the Vander Waal’s equation is </div><div>that all isotherm below critical temperature </div><div>have </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'inflexion point', 'is_correct' => false],
                    ['option' => 'two turning point', 'is_correct' => true],
                    ['option' => 'One turning point', 'is_correct' => false],
                    ['option' => 'melting point', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>In the Vander Waal’s equation for real gas, </div><div>the term 𝑎</div><div>2</div><div>is called </div><div>𝑣</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'Co-volume', 'is_correct' => false],
                    ['option' => 'intermolecular force', 'is_correct' => false],
                    ['option' => 'Internal pressure', 'is_correct' => true],
                    ['option' => 'cohesive force', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>In the Vander Waal’s equation for real gas, </div><div>the term 𝑎</div><div>2</div><div>is called </div><div>𝑣</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'Co-volume', 'is_correct' => false],
                    ['option' => 'intermolecular force', 'is_correct' => false],
                    ['option' => 'Internal pressure', 'is_correct' => true],
                    ['option' => 'cohesive force', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>Which of the following statement about a </div><div>critical temperature is correct</div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'Critical temperature is the temperature  above which a gas cannot be liquefied by  increasing the pressure', 'is_correct' => true],
                    ['option' => 'Critical temperature is the temperature  above which a gas can be liquefied by  increasing the pressure', 'is_correct' => false],
                    ['option' => 'Critical temperature is the temperature  above which a gas cannot be liquefied by  increasing the volume', 'is_correct' => false],
                    ['option' => 'Critical temperature is thetemperature  above which a gas can be liquefied by  increasing the temperature', 'is_correct' => false],
                    ['option' => 'Critical temperature is the temperature  above which a gas cannot be liquefied by  decreasing the pressure', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>For an ideal gas the kinetic energy at </div><div>absolute zero temperature is 0. </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'True', 'is_correct' => true],
                    ['option' => 'False', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>For a real gas the kinetic energy at absolute </div><div>zero temperature is 0. </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'True', 'is_correct' => false],
                    ['option' => 'False', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>The nature of the Vander Waals equation is </div><div>that all isotherms below the critical points </div><div>have ___ points. </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '2', 'is_correct' => true],
                    ['option' => '3', 'is_correct' => false],
                    ['option' => '4', 'is_correct' => false],
                    ['option' => '5', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>The Vander Waal’s equation explains the </div><div>behavior of real gases below the critical </div><div>temperature? </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => 'True', 'is_correct' => false],
                    ['option' => 'False', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>During an adiabatic expansion of 5 moles of </div><div>gas, the internal energy decreases by 75J. The </div><div>work done during the process is </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '-75j', 'is_correct' => false],
                    ['option' => 'Zero', 'is_correct' => false],
                    ['option' => '15j', 'is_correct' => false],
                    ['option' => '75j', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 1,
                'question' => '<div>At the boiling of water the saturated vapour </div><div>pressure will be (in mm of Hg) </div>',
                'marks' => 1.112,
                'options' => [
                    ['option' => '750', 'is_correct' => false],
                    ['option' => '760', 'is_correct' => true],
                    ['option' => '850', 'is_correct' => false],
                    ['option' => '860', 'is_correct' => false],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => 'What will be the resultant force on a body
            of mass 50 kg when it moves with a
            uniform velocity of 10 m/s?<br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => '500 N', 'is_correct' => false],
                    ['option' => '0 N', 'is_correct' => true],
                    ['option' => '5 N', 'is_correct' => false],
                    ['option' => '15 N', 'is_correct' => false],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => 'A riffle bullet weighing 7 g leaves the
            barrel of riffle with a velocity of 300 m/s. If
            the riffle recoils with a velocity of 1 m/s,
            find the mass of the riffle.<br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => '. 2.1 kg', 'is_correct' => true],
                    ['option' => '1.2 kg', 'is_correct' => false],
                    ['option' => '3.4 kg', 'is_correct' => false],
                    ['option' => '2.3 kg', 'is_correct' => false],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => 'Determine the dimension of density.<br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'ML-3', 'is_correct' => true],
                    ['option' => 'ML2T-2', 'is_correct' => false],
                    ['option' => 'ML2', 'is_correct' => false],
                    ['option' => 'MLT-2', 'is_correct' => false],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => 'Which of the following is not a possible unit
                for velocity? <br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'centimetres / month', 'is_correct' => false],
                    ['option' => 'millimetres / kilowatt', 'is_correct' => true],
                    ['option' => 'decimeters / kilosecond', 'is_correct' => false],
                    ['option' => 'kilometres / millisecond', 'is_correct' => false],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => 'Which of the Newton’s law state that, “when a
            body is acted upon by a force, its resulting
            acceleration is directly proportional to the
            force and inversely proportional to the
            mass”?<br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => '. first Newton’s law', 'is_correct' => false],
                    ['option' => 'second Newton’s law', 'is_correct' => true],
                    ['option' => 'third Newton’s law', 'is_correct' => false],
                    ['option' => 'fourth Newton’s law', 'is_correct' => false],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => 'The force acting on a body moving with a
                uniform velocity is<br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'uniform', 'is_correct' => false],
                    ['option' => 'constant', 'is_correct' => false],
                    ['option' => 'zero', 'is_correct' => true],
                    ['option' => 'unknown', 'is_correct' => false],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => '. Which of the following units cannot be used
            to measure speed?<br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'ms-1', 'is_correct' => false],
                    ['option' => 'kms -1', 'is_correct' => false],
                    ['option' => 'mh-1', 'is_correct' => false],
                    ['option' => 'kgs -1', 'is_correct' => true],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => 'The acceleration of a body falling under
            gravity on the surface of the earth is <br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'constant', 'is_correct' => true],
                    ['option' => 'increasing', 'is_correct' => false],
                    ['option' => 'decreasing', 'is_correct' => false],
                    ['option' => 'varies', 'is_correct' => false],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => 'A car moves from rest with an acceleration
            of 0.2 m/s2. Find its velocity when it has
            moved a distance of 50 m.<br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => '4.47 m/s', 'is_correct' => true],
                    ['option' => '10.0 m/s', 'is_correct' => false],
                    ['option' => '250.0 m/s', 'is_correct' => false],
                    ['option' => '. 5.45 m/s', 'is_correct' => false],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => 'A ball is released from a height of 20 m.
            Calculate the velocity with which it hits the
            ground<br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => '12 m/s', 'is_correct' => false],
                    ['option' => '22.6 m/s', 'is_correct' => false],
                    ['option' => '20.0 m/s', 'is_correct' => true],
                    ['option' => '35.6 m/s', 'is_correct' => false],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => 'A body moving with a constant velocity
            along a straight line PQR takes 30 s to go
            from P to Q and 10 s to go from Q to R. If
            PR = 4 m, Find PQ. <br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => '3 m', 'is_correct' => true],
                    ['option' => '1 m', 'is_correct' => false],
                    ['option' => '2 m', 'is_correct' => false],
                    ['option' => '4 m', 'is_correct' => false],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => 'A motor car is uniformly retarded and
            brought to rest from a velocity 36 km/h in
            5 s. Find the distance covered during this
            period.<br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => '25 m', 'is_correct' => true],
                    ['option' => '20 m', 'is_correct' => false],
                    ['option' => '18 m', 'is_correct' => false],
                    ['option' => '18.5 m', 'is_correct' => false],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => 'The thermometric property of a thermocouple is the change in _______. <br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Equivalent resistance', 'is_correct' => false],
                    ['option' => 'Electromotive force', 'is_correct' => true],
                    ['option' => 'Current', 'is_correct' => false],
                    ['option' => 'Pressure', 'is_correct' => false],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => 'The difference observed in solids, liquids and
            gas may be accounted for by   <br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'the spacing and forces acting between the molecules', 'is_correct' => true],
                    ['option' => 'their relative masses', 'is_correct' => false],
                    ['option' => 'the different molecules in each of them', 'is_correct' => false],
                    ['option' => 'their melting point', 'is_correct' => false],
                ],
            ],
            [
               'exam_id' => 1,
                'question' => 'The relationship between volume and
            pressure is investigated when temperature
            and amount of gas are kept constant is
            known as <br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'ideal gas law', 'is_correct' => false],
                    ['option' => 'Avogadro’s law', 'is_correct' => false],
                    ['option' => 'Charles law', 'is_correct' => false],
                    ['option' => 'Boyle’s law', 'is_correct' => true],
                ],
            ],

            // Maths
            [
                'exam_id' => 4,
                'question' => 'Find dy/dx if x - y = 1<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '-x/y', 'is_correct' => true],
                    ['option' => 'x/y', 'is_correct' => false],
                    ['option' => '-1/2', 'is_correct' => false],
                    ['option' => '1/2(1 - x )', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => ' Find dy/dx when xy = 1<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '-1', 'is_correct' => false],
                    ['option' => '-x', 'is_correct' => false],
                    ['option' => 'x', 'is_correct' => false],
                    ['option' => '-1/x', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => ' x + y = 2 xy find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '1', 'is_correct' => false],
                    ['option' => '-1', 'is_correct' => false],
                    ['option' => 'x/y', 'is_correct' => false],
                    ['option' => '-y/x', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => ') If 2 x y = 3, find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '-2 y /x', 'is_correct' => true],
                    ['option' => '-2 x /y', 'is_correct' => false],
                    ['option' => '-x/y', 'is_correct' => false],
                    ['option' => 'x/y', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Let x + y + xy = 3. Find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '-(2x + y)(2y + x)', 'is_correct' => true],
                    ['option' => '(2y + x)(2x + y)', 'is_correct' => false],
                    ['option' => '- (2 y + x )( 2x + y )', 'is_correct' => false],
                    ['option' => '(2 x + y)(2 y + x)', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Given that y = 2x - 3x + x, find dy/dx at x = 1<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '1', 'is_correct' => true],
                    ['option' => '13', 'is_correct' => false],
                    ['option' => '-1', 'is_correct' => false],
                    ['option' => '12', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => '(1)Finddy/dxifx2 -y2 =1<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '-x/y', 'is_correct' => true],
                    ['option' => 'x/y', 'is_correct' => false],
                    ['option' => '-1/2', 'is_correct' => false],
                    ['option' => '1/2(1 - x2)', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => '(2) Find dy/dx when xy = 1<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '-1', 'is_correct' => false],
                    ['option' => '-x', 'is_correct' => false],
                    ['option' => 'X', 'is_correct' => false],
                    ['option' => '-1/x', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => '(3) x + y = 2 xy find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '1', 'is_correct' => false],
                    ['option' => '-1', 'is_correct' => false],
                    ['option' => 'X/y', 'is_correct' => false],
                    ['option' => '-y/x', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => '(4) If 2 x y = 3, find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '-2y/x', 'is_correct' => true],
                    ['option' => '-2x/y', 'is_correct' => false],
                    ['option' => '-x/y', 'is_correct' => false],
                    ['option' => 'X/y', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => '(5) Let x + y + xy = 3. Find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '[A] -(2x + y)(2y + x)', 'is_correct' => true],
                    ['option' => '[B] (2y + x)(2x + y)', 'is_correct' => false],
                    ['option' => '[C] - (2 y + x )( 2x + y )', 'is_correct' => false],
                    ['option' => '[D](2 x + y)(2 y + x)', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => '(6) x y - x - y = 0, find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '[A] - (2 xy - 1)(1 - 2x y)', 'is_correct' => false],
                    ['option' => '[B] (2xy - 1)(1 - 2x y)', 'is_correct' => true],
                    ['option' => '[C] (1 - 2x y)(2xy - 1)', 'is_correct' => false],
                    ['option' => '[D](2 xy - 1)(2xy -1)', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => '(7) Let y = 2x + x + 1, find d y/d x<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '6x + 2x', 'is_correct' => false],
                    ['option' => '2 + 12x', 'is_correct' => true],
                    ['option' => '6x', 'is_correct' => false],
                    ['option' => '12x', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'f(x) = (x - 2)(4 x + 1), find d f /dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '16x + 3x - 8', 'is_correct' => false],
                    ['option' => '16x + 3x', 'is_correct' => false],
                    ['option' => '16x + 6x', 'is_correct' => false],
                    ['option' => '48x + 6x', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => ' If y = 1/x, find d y dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '6x', 'is_correct' => false],
                    ['option' => '-6x', 'is_correct' => false],
                    ['option' => '-6x', 'is_correct' => true],
                    ['option' => '2x', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'y = 2x - 1, find d y/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '4', 'is_correct' => false],
                    ['option' => '2x', 'is_correct' => false],
                    ['option' => '1', 'is_correct' => false],
                    ['option' => '0', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => ' y = (1 - 2x)<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '4(1 - 2x )', 'is_correct' => false],
                    ['option' => '-4(1 - 2x)', 'is_correct' => true],
                    ['option' => '2(1 - 2x)', 'is_correct' => false],
                    ['option' => '-2(1 - 2x)', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'y = sin 3 x find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '3cos3 x', 'is_correct' => true],
                    ['option' => '3cosxsinx', 'is_correct' => false],
                    ['option' => '3cos3xsin3x', 'is_correct' => false],
                    ['option' => '3sin3x', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'If y = (sinx) , obtain dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'csinxcosx', 'is_correct' => false],
                    ['option' => 'c(sinx) cosx', 'is_correct' => true],
                    ['option' => 'c(cosx) sinx', 'is_correct' => false],
                    ['option' => 'ccosx', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'y = sin 2x, find dy/dx<br>',
                'marks' => 2.1,
                'options' => [
                    ['option' => '6sin 2xcos2x', 'is_correct' => true],
                    ['option' => '2xcos2x', 'is_correct' => false],
                    ['option' => '6sin2xcos 2x', 'is_correct' => false],
                    ['option' => '6cos2x', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'If y = (sinx) , obtain dy/dx<br>',
                'marks' => 2.1,
                'options' => [
                    ['option' => 'csinxcosx', 'is_correct' => false],
                    ['option' => 'c(sinx) cosx', 'is_correct' => true],
                    ['option' => 'c(cosx) sinx', 'is_correct' => false],
                    ['option' => 'ccosx', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Differentiate with respect to x, given y = sin x<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '5sin xcosx', 'is_correct' => true],
                    ['option' => '5cosxsinx', 'is_correct' => false],
                    ['option' => '5cos xsinx', 'is_correct' => false],
                    ['option' => '4sinx cosx', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'If q = sinx cosx find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'cos x - sin x', 'is_correct' => true],
                    ['option' => 'sin x - cos x', 'is_correct' => false],
                    ['option' => 'sin x - cos x', 'is_correct' => false],
                    ['option' => 'cos x - sin x', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Given that y = 2x - 3x + x, find dy/dx at x =<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '1', 'is_correct' => true],
                    ['option' => '13', 'is_correct' => false],
                    ['option' => '-1', 'is_correct' => false],
                    ['option' => '-13', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Find the tangent to the curve y = x - x - 6 at x = 1/<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '0', 'is_correct' => true],
                    ['option' => '-6', 'is_correct' => false],
                    ['option' => '1/2', 'is_correct' => false],
                    ['option' => '-1/2', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Given y = log x , find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '1/2x', 'is_correct' => false],
                    ['option' => '1/x', 'is_correct' => false],
                    ['option' => '2/x', 'is_correct' => true],
                    ['option' => '2/x', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Given y = log(1 - x ), find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '-2x(1 - x )', 'is_correct' => true],
                    ['option' => '(1-x)-1', 'is_correct' => false],
                    ['option' => '1-x', 'is_correct' => false],
                    ['option' => '2x(1-x)', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Let v = t - 2t + t gives the velocity of an object at time t (we define acceleration as change in velocity with time). Obtain an expression for the acceleration of the object<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'a = 2t - t', 'is_correct' => false],
                    ['option' => 'a = 3t - 4t', 'is_correct' => false],
                    ['option' => '3t - 4t + 1', 'is_correct' => true],
                    ['option' => 'v/t', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Find dy/dx if y = cos2x<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '-2sin2xcos2x  [C', 'is_correct' => false],
                    ['option' => '-2sin2x', 'is_correct' => true],
                    ['option' => '-2cos2x', 'is_correct' => false],
                    ['option' => '2sin2x', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'find dy/dx for y = cos x<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '-cos2x sin2x', 'is_correct' => false],
                    ['option' => '-2cosx sinx', 'is_correct' => true],
                    ['option' => '-2cosx sin2x', 'is_correct' => false],
                    ['option' => '2sin2x cos2x', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'y = sin (3x), find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '(1 - 9x)', 'is_correct' => false],
                    ['option' => '3(1 - 9x )', 'is_correct' => true],
                    ['option' => '9x (1 + 9x )', 'is_correct' => false],
                    ['option' => '3(1 + 9x )', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Find the differential coefficient of y with respect to x given that y = (3x - 4)<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '24x(3x - 4)', 'is_correct' => true],
                    ['option' => '24x(3x + 4)', 'is_correct' => false],
                    ['option' => '24x(3x - 4)', 'is_correct' => false],
                    ['option' => '24x(3x - 4)', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'If v = sin u, d v/du is what?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'V', 'is_correct' => true],
                    ['option' => 'U', 'is_correct' => false],
                    ['option' => '-v', 'is_correct' => false],
                    ['option' => '-u', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'If y = tan x, find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'sin x', 'is_correct' => false],
                    ['option' => 'sec x', 'is_correct' => true],
                    ['option' => 'cos x', 'is_correct' => false],
                    ['option' => 'cosec x', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Given y = 2xcosx, find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '2cosx + sinx', 'is_correct' => false],
                    ['option' => '2cosx - sinx', 'is_correct' => false],
                    ['option' => '2(cosx + sinx)', 'is_correct' => true],
                    ['option' => '2(cosx - sinx)', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Given that y = (1 - 2x ) , find dy/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '-6x(1 - 2x)', 'is_correct' => false],
                    ['option' => '-12x(1 - 2x )', 'is_correct' => false],
                    ['option' => '12x(1 + 12x)', 'is_correct' => false],
                    ['option' => '12x(1 - 12x )', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Obtain the limit of (x + 1) as x--&gt; 2<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '1/3', 'is_correct' => true],
                    ['option' => '1', 'is_correct' => false],
                    ['option' => '0', 'is_correct' => false],
                    ['option' => '1/2', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Obtain the limit of 1/x : x--&gt;0<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '1', 'is_correct' => false],
                    ['option' => '0', 'is_correct' => true],
                    ['option' => '-1', 'is_correct' => false],
                    ['option' => 'Infinite', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Obtain the limit of 2(x - 1) : x--&gt;2<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '2/3', 'is_correct' => true],
                    ['option' => '1/4', 'is_correct' => false],
                    ['option' => '3/2', 'is_correct' => false],
                    ['option' => '0', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Given y = sec x, find dy/dx (Hint let = 1/cosx)<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'tanx secx', 'is_correct' => true],
                    ['option' => 'tanx cosecx', 'is_correct' => false],
                    ['option' => 'cosec x', 'is_correct' => false],
                    ['option' => 'tanx secx', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'u = tan (3v ), obtain du/dv<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'v (1 + 9v )', 'is_correct' => true],
                    ['option' => 'v (1 + 9v )', 'is_correct' => false],
                    ['option' => '9v (1 + 9v )', 'is_correct' => false],
                    ['option' => '9v (1 + 9v )', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Find dy/dx where y = cos 6x<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '-6(1 - 36x )', 'is_correct' => true],
                    ['option' => '6(1 - 36x )', 'is_correct' => false],
                    ['option' => '(1 - 36x )', 'is_correct' => false],
                    ['option' => '-1(1 - 36x ) (37) If y = uvw whe', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'If y = uvw where u, v and w are functions of x. express dv/dx<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '(uv)dw/dx + (uw)dv/dx + (vw)du/d', 'is_correct' => true],
                    ['option' => '(uv)dw/dx + (vw)dv/dx + (vu)du/dx', 'is_correct' => false],
                    ['option' => '(uv)dw/dx + (uw)dv/dx + (v)dwu/dx', 'is_correct' => false],
                    ['option' => '(uv)dw/dx + (uw)dv/dx - (vw)du/dx', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'f y = kx where (k = constant) dy /dx is what?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'K', 'is_correct' => false],
                    ['option' => 'K', 'is_correct' => false],
                    ['option' => '2k', 'is_correct' => true],
                    ['option' => '4x', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Given that t = 5k. where k is constant, obtain dt/dk [A] 5<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '0', 'is_correct' => true],
                    ['option' => '1', 'is_correct' => false],
                    ['option' => '2', 'is_correct' => false],
                    ['option' => '5k', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 4,
                'question' => 'Given that t = 5k. where k is constant, obtain dt/dk [A] 5<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Infinite', 'is_correct' => false],
                    ['option' => 'X', 'is_correct' => false],
                    ['option' => '0', 'is_correct' => true],
                    ['option' => 'X+&', 'is_correct' => false],
                ],
            ],

            //TODO:  Chemistry
            [
                'exam_id' => 2,
                'question' => 'A chemical reaction is said to be at equilibrium at. <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'A: Minimal degree of freedom and maximum entropy', 'is_correct' => true],
                    ['option' => 'Minimal degree of freedom and minimal entropy', 'is_correct' => false],
                    ['option' => 'Maximum degree of freedom and maximum entropy', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Predict the spontaneity of a chemical process if &amp;Delta;G&lt;sup&gt;o&lt;/sup&gt; = 141.7 and K = 1.4 x 10&lt;sup&gt;-25&lt;/sup&gt; at 298K. <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Spontaneous process', 'is_correct' => false],
                    ['option' => 'Non spontaneous', 'is_correct' => true],
                    ['option' => ': An equilibrium Process', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Estimate the boiling point of water given &amp;Delta;H&lt;sup&gt;o&lt;/sup&gt; = 44.01KJmol&lt;sup&gt;-1&lt;/sup&gt; and &amp;Delta;S&lt;sup&gt;o&lt;/sup&gt; = 118.3 J/Kmol&lt;sup&gt;-1&lt;/sup&gt;. <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '100<sup>o</sup> C', 'is_correct' => false],
                    ['option' => '93.7<sup>o</sup> C', 'is_correct' => false],
                    ['option' => 'C: 97.3<sup>o</sup> C', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Which of the following statements is true for the effect of catalyst on equilibrium. <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'affects the rates of the reaction', 'is_correct' => true],
                    ['option' => 'alter the equilibrium position', 'is_correct' => false],
                    ['option' => 'no effect on rates and equilibrium Position', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Which of the following principles is used in predicting changes in equilibrium concentrations? <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Le Chateliers', 'is_correct' => false],
                    ['option' => 'Zeroth', 'is_correct' => true],
                    ['option' => 'Boyles', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'The following reaction is at equilibrium. &lt;br /&gt; C&lt;sub&gt;l2&lt;/sub&gt; (g) + 3F&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2ClF&lt;sub&gt;3&lt;/sub&gt; (g) &lt;br /&gt; How will the system respond if the volume is increased at constant Temperature <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'The reaction will shift to the right.', 'is_correct' => false],
                    ['option' => 'There will be no change to the equilibrium', 'is_correct' => false],
                    ['option' => 'The reaction will shift to the left', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'The following reaction is at equilibrium. &lt;br /&gt; CF&lt;sub&gt;2&lt;/sub&gt; Br&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; CF&lt;sub&gt;2&lt;/sub&gt; (g) + 2Br(g) &amp;Delta;H= 424 kJ mol&lt;sup&gt;–1&lt;/sup&gt; &lt;br /&gt; How will the system respond if the temperature is decreased?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'The reaction will shift to the lef', 'is_correct' => true],
                    ['option' => 'The reaction will shift to the right.', 'is_correct' => false],
                    ['option' => 'Reactions stop nonsense', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Consider this equation: 2CO(g) + O&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2CO&lt;sub&gt;2&lt;/sub&gt; (g) &lt;br /&gt; Suppose the equation is rewritten as CO(g) + 1⁄2O&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; CO&lt;sub&gt;2&lt;/sub&gt; (g)<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Kc<sup>,</sup> = Kc', 'is_correct' => false],
                    ['option' => 'Kc<sup>,</sup> = (Kc) 1⁄2', 'is_correct' => true],
                    ['option' => 'C: Kc<sup>,</sup> = 1⁄2(Kc)', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Identify the INCORRECT statement below regarding chemical equilibrium. <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'All chemical reactions are principle and reversible', 'is_correct' => false],
                    ['option' => 'B: Equilibrium is achieved when the concentrations of Species become constant', 'is_correct' => false],
                    ['option' => 'Equilibrium is achieved when reactant and product concentrations are equal.', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'In which of the following reactions will the point of equilibrium shift to the left when the pressure on the system is increased? <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'C(s) + O<sub>2</sub> (g) &harr; CO<sub>2</sub> (g)', 'is_correct' => false],
                    ['option' => 'CaCO<sub>3</sub> (s) &harr; CaO(s) + CO<sub>2</sub> (g)', 'is_correct' => true],
                    ['option' => ': 2Mg(s) + O<sub>2</sub> (g) &harr; 2MgO(s)', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => '<div>s)</div><div>What happens when a catalyst is added to a system at equilibrium</div>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'The reaction follows an alternative pathway of lower activation energy.', 'is_correct' => true],
                    ['option' => 'The heat of reaction decreases', 'is_correct' => false],
                    ['option' => 'The heat of reaction decreases. C: The potential energy of the reactants decreases.', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'The reaction A &amp;harr; B has an equilibrium constant of K = 10&lt;sup&gt;–4&lt;/sup&gt; . Which of the following statements is always correct? A: The reaction will have 50% product B and 50% reactant<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'at equilibriuM', 'is_correct' => false],
                    ['option' => 'The reaction is very favourable and will have mostly product B at equilibrium.', 'is_correct' => false],
                    ['option' => 'The reaction is unfavourable and will not have very much product B at equilibrium.', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Which of the following statements most accurately relates the properties of a liquid at room temperature with its vapour pressure?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'liquid low vapour pressure will probably have a high surface tension and a high boiling point', 'is_correct' => true],
                    ['option' => 'liquid low vapour pressure will probably have a low surface tension and a high boiling point.', 'is_correct' => false],
                    ['option' => 'liquid low vapour pressure will probably have a low surface tension and a high boiling point. Surface tension and a high boiling point', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Which of the following is true for the composition of equilibrium mixture. If &amp;Delta;G = 0 and&lt;i&gt; K&lt;/i&gt; = 1 the mixture is.<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Mostly products', 'is_correct' => false],
                    ['option' => 'Mostly reactants', 'is_correct' => false],
                    ['option' => 'Neither reactants nor products are favoured', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Which of the following is true for the composition of equilibrium mixture. If &amp;Delta;G = 0 and&lt;i&gt; K&lt;/i&gt; = 1 the mixture is.<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Mostly products', 'is_correct' => false],
                    ['option' => 'Mostly reactants', 'is_correct' => false],
                    ['option' => 'Neither reactants nor products are favoured', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Calculate the value of K at 298K for the following reaction N&lt;sub&gt;2&lt;/sub&gt; (g) + 3H&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2NH&lt;sub&gt;3&lt;/sub&gt; (g) &lt;br /&gt; Given &amp;Delta;G = -32.96KJmol-1<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '5.97 x 10<sup>5</sup>', 'is_correct' => true],
                    ['option' => ': 13.3', 'is_correct' => false],
                    ['option' => '-13.3', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Of the following reactions, which of the reaction process is only spontaneous at high temperatures<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '? A: &Delta;H +, &Delta; S', 'is_correct' => false],
                    ['option' => '&Delta;H +, &Delta; S +', 'is_correct' => true],
                    ['option' => '&Delta;H –, &Delta; S –', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'O&lt;sub&gt;2&lt;/sub&gt; (g) &amp;rarr;2CO(g) &lt;br /&gt; How does the spontaneity of this process depend upon temperature?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'spontaneous (&Delta;G < 0) at all temperatures.', 'is_correct' => true],
                    ['option' => 'Non spontaneous process', 'is_correct' => false],
                    ['option' => 'Spontaneous process at high temperatures', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'condition of a predation process describes an endothermic process with an increase in system entropy, ?G will be negative if. <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'T&Delta;S is greater than &Delta;H', 'is_correct' => true],
                    ['option' => 'T&Delta;S is less than &Delta;H', 'is_correct' => false],
                    ['option' => 'T&Delta;S = 0', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'At 25&lt;sup&gt;?&lt;/sup&gt;C, a reaction has a Gibb\'s free energy change of +45kJ. If the enthalpy change of the reaction is +35kJ, what is the entropy change of the reaction?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '-400jk', 'is_correct' => false],
                    ['option' => '-33.6JK', 'is_correct' => true],
                    ['option' => '33.6JK Energy c', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Energy can neither be created nor destroyed but can be converted from one form to other is inferred from. <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'zeroth low of thermodynamic', 'is_correct' => false],
                    ['option' => 'first law of thermodynamics', 'is_correct' => true],
                    ['option' => 'second law to thermodynamics Fr', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'From the eqution 2NO&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; N&lt;sub&gt;2&lt;/sub&gt; O&lt;sub&gt;4&lt;/sub&gt; (g) &lt;br /&gt; When the value of the reaction quotient before any reaction occurs is zero (0 ) at 25 °C, the concentration changes so that at equilibrium, [NO&lt;sub&gt;2&lt;/sub&gt; ] = 0.016 M and [N&lt;sub&gt;2&lt;/sub&gt; O&lt;sub&gt;4&lt;/sub&gt; ] = 0.042 M. &lt;br /&gt; What is the value of the equilibrium constant for the reaction?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'A: 1.6 x 10<sup>2</sup>', 'is_correct' => false],
                    ['option' => '1.6 x 10<sup>5</sup> C: 0.016 For the reaction, 2SO<sub>2</sub> (g) + O<sub>2</sub> (g) &harr; 2SO<sub>3</sub> (g) the concentrations at equilibrium are <br /> [SO<sub>2</sub> ] = 0.90 M, [O<sub>2</sub> ] = 0.35 M, and [SO<sub>3</sub> ] = 1.1 M. What is t', 'is_correct' => false],
                    ['option' => 'C: <i>K<sub>c</sub> </i> = 4.3', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => '<div><span style="color: rgb(33, 37, 41); font-size: 1rem; -webkit-tap-highlight-color: transparent;">A </span><span style="color: rgb(33, 37, 41); font-size: 1rem; -webkit-tap-highlight-color: transparent; -webkit-option-size-adjust: 100%;">1.00-L flask containing 0.0500 mol of NO(g), 0.0155 mol of Cl2(g), and 0.500 mol of NOCl &lt;br /&gt; 2NO(g) + Cl&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2NOCl(g) &lt;i&gt;K&lt;sub&gt;c&lt;/sub&gt; &lt;/i&gt; = 4.6 × 104 &lt;br /&gt;</span><span style="color: rgb(33, 37, 41); font-size: 1rem; -webkit-tap-highlight-color: transparent; -webkit-option-size-adjust: 100%;"> Calculate the reaction quotient and determine the direction of the equilibrium shift</span><br></div>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '<i>Q<sub>c</sub> </i> =1.9 x 10<sup>-7</sup> , shift left', 'is_correct' => false],
                    ['option' => 'B: <i>Q<sub>c</sub> </i> = 6.45 x 10<sup>3</sup> , shift right', 'is_correct' => true],
                    ['option' => ': <i>Q<sub>c</sub> </i> =4.6 x 10<sup>4</sup> , none is favoured', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Which of the statements defines the&lt;b&gt; activity&lt;/b&gt; of a substance<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'A: degree of randomness of a system', 'is_correct' => false],
                    ['option' => 'a measure of its effective concentration under specified conditions', 'is_correct' => true],
                    ['option' => ': a measure of heat content of a substance', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'A system in which reactants and products are found in two or more phases is a<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Phase equilibrium B: chemical equilibrium', 'is_correct' => false],
                    ['option' => 'chemical equilibrium', 'is_correct' => false],
                    ['option' => 'Heterogeneous equilibrium', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'One of the following is an example of heterogeneous equilibria<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'C<sub>2</sub> H<sub>6</sub> (g) &harr; C<sub>2</sub> H<sub>4</sub> (g) + H<sub>2</sub> (g)', 'is_correct' => false],
                    ['option' => 'B: CO(g) + H<sub>2</sub> O(g) &harr; CO<sub>2</sub> (g) + H<sub>2</sub> (g)', 'is_correct' => false],
                    ['option' => 'PbCl<sub>2</sub> (s) &rarr;Pb<sup>2+</sup> (aq) + 2Cl<sup>-</sup> (aq)', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'A chemical reaction is said to be at equilibrium at. <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Minimal degree of freedom and maximum entropy', 'is_correct' => true],
                    ['option' => 'Minimal degree of freedom and minimal entropy', 'is_correct' => false],
                    ['option' => 'Minimal degree of freedom and minimal entropy Minimal degree of freedom', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Predict the spontaneity of a chemical process if &amp;Delta;G&lt;sup&gt;o&lt;/sup&gt; = 141.7 and K = 1.4 x 10&lt;sup&gt;-25&lt;/sup&gt; at 298K.<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Spontaneous process', 'is_correct' => false],
                    ['option' => 'Non spontaneous process', 'is_correct' => true],
                    ['option' => 'An equilibrium process', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Estimate the boiling point of water given &amp;Delta;H&lt;sup&gt;o&lt;/sup&gt; = 44.01KJmol&lt;sup&gt;-1&lt;/sup&gt; and &amp;Delta;S&lt;sup&gt;o&lt;/sup&gt; = 118.3 J/Kmol&lt;sup&gt;-1&lt;/sup&gt;. <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '93.7<sup>o</sup>', 'is_correct' => false],
                    ['option' => '97.3<sup>o</sup>', 'is_correct' => true],
                    ['option' => '97.3kj/mol', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Which of the following statements is true for the effect of catalyst on equilibrium. <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'affects the rates of the reactions B', 'is_correct' => true],
                    ['option' => 'alter the equilibrium position C: catalyst remains in the reactants Which of the following principles is used in predicting changes in equilibrium concentrations? A: Fritz Haber', 'is_correct' => false],
                    ['option' => 'catalyst remains in the reactants', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'hich of the following principles is used in predicting changes in equilibrium concentrations? <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Fritz Haber', 'is_correct' => false],
                    ['option' => 'Le Chateliers', 'is_correct' => true],
                    ['option' => 'Zeroth', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'The following reaction is at equilibrium. &lt;br /&gt; C&lt;sub&gt;l2&lt;/sub&gt; (g) + 3F&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2ClF&lt;sub&gt;3&lt;/sub&gt; (g) &lt;br /&gt; How will the system respond if the volume is increased at constant temperature?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'The reaction will shift to the right', 'is_correct' => false],
                    ['option' => 'There will be no change to the equilibrium position', 'is_correct' => false],
                    ['option' => 'The reaction will shift to the left', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'The following reaction is at equilibrium. &lt;br /&gt; CF&lt;sub&gt;2&lt;/sub&gt; Br&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; CF&lt;sub&gt;2&lt;/sub&gt; (g) + 2Br(g) &amp;Delta;H= 424 kJ mol&lt;sup&gt;–1&lt;/sup&gt; &lt;br /&gt; How will the system respond if the temperature is decreased?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'The reaction will shift to the left.', 'is_correct' => true],
                    ['option' => ': The reaction will shift to the right.', 'is_correct' => false],
                    ['option' => 'Reaction stops', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Consider this equation: 2CO(g) + O&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2CO&lt;sub&gt;2&lt;/sub&gt; (g) &lt;br /&gt; Suppose the equation is rewritten as CO(g) + 1⁄2O&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; CO&lt;sub&gt;2&lt;/sub&gt; (g) with an equilibrium constant Kc\'. What is the relationship between Kc and Kc\'? <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Kc<sup>,</sup> = Kc', 'is_correct' => false],
                    ['option' => 'Kc<sup>,</sup> = Kc', 'is_correct' => true],
                    ['option' => 'Kc<sup>,</sup> = 1⁄2(Kc)', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'ntify the INCORRECT statement below regarding chemical equilibrium. <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'All chemical reactions are, in principle, reversible.', 'is_correct' => false],
                    ['option' => 'Equilibrium is achieved when the concentrations of species become constan', 'is_correct' => false],
                    ['option' => 'Equilibrium is achieved when reactant and product concentrations are equal.', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'In which of the following reactions will the point of equilibrium shift to the left when the pressure on the system is increased? <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'C(s) + O<sub>2</sub> (g) &harr; CO<sub>2</sub> (g)', 'is_correct' => false],
                    ['option' => 'CaCO<sub>3</sub> (s) &harr; CaO(s) + CO<sub>2</sub> (g)', 'is_correct' => true],
                    ['option' => '2Mg(s) + O<sub>2</sub> (g) &harr; 2MgO(S)', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'What happens when a catalyst is added to a system at equilibrium?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'The reaction follows an alternative pathway of lower activation energy', 'is_correct' => true],
                    ['option' => 'The heat of reaction decreases.', 'is_correct' => false],
                    ['option' => 'The potential energy of the reactants decreases.', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'The reaction A &amp;harr; B has an equilibrium constant of K = 10&lt;sup&gt;–4&lt;/sup&gt; . Which of the following statements is always correct? <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'The reaction will have 50% product B and 50% reactant A at equilibrium.', 'is_correct' => false],
                    ['option' => 'The reaction is very favourable and will have mostly product B at equilibrium.', 'is_correct' => false],
                    ['option' => 'The reaction is unfavourable and will not have very much product B at equilibrium.', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Which of the following statements most accurately relates the properties of a liquid at room temperature with its vapour pressure?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'liquid low vapour pressure will probably have a high surface tension and a high boiling point.', 'is_correct' => true],
                    ['option' => 'liquid low vapour pressure will probably have a low surface tension and a high boiling point.', 'is_correct' => false],
                    ['option' => 'liquid high vapour pressure will probably have a low surface tension and a high boiling point.', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'For a reversible reaction, the equilibrium lies to the.<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Left', 'is_correct' => false],
                    ['option' => 'Right', 'is_correct' => true],
                    ['option' => 'Middle', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Which of the following is true for the composition of equilibrium mixture. If &amp;Delta;G = 0 and&lt;i&gt; K&lt;/i&gt; = 1 the mixture is. <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Mostly products', 'is_correct' => false],
                    ['option' => 'Mostly reactants', 'is_correct' => false],
                    ['option' => 'Neither reactants or product are favored', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Calculate the value of K at 298K for the following reaction N&lt;sub&gt;2&lt;/sub&gt; (g) + 3H&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2NH&lt;sub&gt;3&lt;/sub&gt; (g) &lt;br /&gt; Given &amp;Delta;G = -32.96KJmol-1.<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '5.97 x 10<sup>5</sup>', 'is_correct' => true],
                    ['option' => ': 13.3 C: -13.3', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Of the following reactions, which of the reaction process is only spontaneous at high temperatures? <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '&Delta;H +, &Delta; S -', 'is_correct' => false],
                    ['option' => '&Delta;H +, &Delta; S +', 'is_correct' => true],
                    ['option' => '&Delta;H –, &Delta; S –', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'The incomplete combustion of carbon is described by the following equation &lt;br /&gt; 2C(s) + O&lt;sub&gt;2&lt;/sub&gt; (g) &amp;rarr;2CO(g) &lt;br /&gt; How does the spontaneity of this process depend upon temperature? <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'spontaneous (&Delta;G < 0) at all temperatures.', 'is_correct' => true],
                    ['option' => 'Spontaneous process at high temperatures', 'is_correct' => false],
                    ['option' => 'Non spontaneous process', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'If &amp;Delta;H is negative and &amp;Delta;S is positive, this condition describes.<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Spontaneous process at low temperature', 'is_correct' => false],
                    ['option' => 'Non spontaneous process', 'is_correct' => false],
                    ['option' => 'Spontaneous process at all temperatures', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'A condition of a predation process describes an endothermic process with an increase in system entropy, ?G will be negative if. <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'T&Delta;S is greater than &Delta;H', 'is_correct' => true],
                    ['option' => 'T&Delta;S is less than &Delta;H', 'is_correct' => false],
                    ['option' => 'T&Delta;S = 0', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'At 25&lt;sup&gt;?&lt;/sup&gt;C, a reaction has a Gibb\'s free energy change of +45kJ. If the enthalpy change of the reaction is +35kJ, what is the entropy change of the reaction?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '-400JK', 'is_correct' => false],
                    ['option' => '-33.6JK', 'is_correct' => true],
                    ['option' => '33.6JK', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'Energy can neither be created nor destroyed but can be converted from one form to other is inferred from. <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'zeroth low of thermodynamic', 'is_correct' => false],
                    ['option' => 'first law of thermodynamics', 'is_correct' => true],
                    ['option' => 'second law to thermodynamiace', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'From the equation 2NO&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; N&lt;sub&gt;2&lt;/sub&gt; O&lt;sub&gt;4&lt;/sub&gt; (g) &lt;br /&gt; When the value of the reaction quotient before any reaction occurs is zero (0 ) at 25 °C, the concentration changes so that at equilibrium, [NO&lt;sub&gt;2&lt;/sub&gt; ] = 0.016 M and N&lt;sub&gt;2&lt;/sub&gt; O&lt;sub&gt;4&lt;/sub&gt; ] = 0.042 M. &lt;br /&gt; What is the value of the equilibrium constant for the reaction?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '1.6 x 10<sup>2</sup>', 'is_correct' => true],
                    ['option' => '-1.6 x 10<sup>5</sup>', 'is_correct' => false],
                    ['option' => '0.016', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 2,
                'question' => 'For the reaction, 2SO&lt;sub&gt;2&lt;/sub&gt; (g) + O&lt;sub&gt;2&lt;/sub&gt; (g) &amp;harr; 2SO&lt;sub&gt;3&lt;/sub&gt; (g) the concentrations at equilibrium are &lt;br /&gt; [SO&lt;sub&gt;2&lt;/sub&gt; ] = 0.90 M, [O&lt;sub&gt;2&lt;/sub&gt; ] = 0.35 M, and [SO&lt;sub&gt;3&lt;/sub&gt; ] = 1.1 M. What is the value of the equilibrium constant, &lt;i&gt;K&lt;sub&gt;c&lt;/sub&gt; &lt;/i&gt; ?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'A: <i>K<sub>c</sub> </i> = 3.4', 'is_correct' => false],
                    ['option' => '<i>K<sub>c</sub> </i> = 6.9', 'is_correct' => false],
                    ['option' => '<i>K<sub>c</sub> </i> = 4.3', 'is_correct' => true],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<span style="font-size:11.0pt;line-height:115%;
                font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
                &quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
                mso-bidi-language:AR-SA">In the early 19th century, the discovery of what
                substance was a turning point in the debate between vitalism and mechanism in
                organic chemistry?</span><br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Urea', 'is_correct' => true],
                    ['option' => 'Ethanol', 'is_correct' => false],
                    ['option' => 'Benzene', 'is_correct' => false],
                    ['option' => 'Hydrochloric acid', 'is_correct' => false],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<span style="font-size:11.0pt;line-height:115%;
                font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
                &quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
                mso-bidi-language:AR-SA">What is the name of the chemical process discovered by
                Friedrich Wöhler in 1828 that demonstrated the synthesis of urea from inorganic
                materials, disproving the theory of vitalism?</span><br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Fermentation', 'is_correct' => false],
                    ['option' => 'Electrophilic addition', 'is_correct' => false],
                    ['option' => 'Urease reaction', 'is_correct' => false],
                    ['option' => 'Urea synthesis', 'is_correct' => true],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<p class="MsoNormal">What is the name of the reaction that converts alkenes or
                alkynes into alkanes by the addition of hydrogen in the presence of a catalyst,
                a fundamental process in organic chemistry?<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Dehydration', 'is_correct' => false],
                    ['option' => 'Hydrogenation', 'is_correct' => true],
                    ['option' => 'Polymerization', 'is_correct' => false],
                    ['option' => 'Oxidation', 'is_correct' => false],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<span style="font-size:11.0pt;line-height:115%;
                font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
                &quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
                mso-bidi-language:AR-SA">Who was the first woman to win a Nobel Prize and the
                only person to win Nobel Prizes in two different scientific fields, including
                one in chemistry for her work on radioactivity and the discovery of radium and
                polonium?</span><br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Rosalind Franklin', 'is_correct' => false],
                    ['option' => 'Marie Curie', 'is_correct' => true],
                    ['option' => 'Dorothy Crowfoot Hodgkin', 'is_correct' => false],
                    ['option' => 'Linus Pauling', 'is_correct' => false],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<span style="font-size:11.0pt;line-height:115%;
            font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
            &quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
            mso-bidi-language:AR-SA">In the context of organic chemistry, what is the IUPAC
            name for the compound CH3-CH2-CH2-CHO?</span><br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Propanone', 'is_correct' => false],
                    ['option' => 'Propanal', 'is_correct' => true],
                    ['option' => 'Butanone', 'is_correct' => false],
                    ['option' => 'Butanal', 'is_correct' => false],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<span style="font-size:11.0pt;line-height:115%;
            font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
            &quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
            mso-bidi-language:AR-SA">Which organic compound is commonly known as "wood
            alcohol"?</span><br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Ethanol', 'is_correct' => false],
                    ['option' => 'Methanol', 'is_correct' => true],
                    ['option' => 'Isopropanol', 'is_correct' => false],
                    ['option' => 'Butanol', 'is_correct' => false],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<span style="font-size:11.0pt;line-height:115%;
            font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
            &quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
            mso-bidi-language:AR-SA">Who is known for the discovery of the first
            antibiotic, penicillin, which revolutionized medicine and had a significant
            impact on organic chemistry?</span><br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Alexander Fleming', 'is_correct' => true],
                    ['option' => 'Louis Pasteur', 'is_correct' => false],
                    ['option' => 'Joseph Priestley', 'is_correct' => false],
                    ['option' => 'Robert Koch', 'is_correct' => false],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<span style="font-size:11.0pt;line-height:115%;
            font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
            &quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
            mso-bidi-language:AR-SA">Which organic molecule is the primary structural
            component of the cell membrane and plays a crucial role in cell biology and
            biochemistry?</span><br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'DNA', 'is_correct' => false],
                    ['option' => 'RNA', 'is_correct' => false],
                    ['option' => 'Protein', 'is_correct' => false],
                    ['option' => 'Phospholipid', 'is_correct' => true],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<p class="MsoNormal">Who is the American chemist famous for his research on
            synthetic polymers and the invention of nylon, a significant development in the
            field of organic chemistry?<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Linus Pauling', 'is_correct' => false],
                    ['option' => 'Wallace Carothers', 'is_correct' => true],
                    ['option' => 'Hermann Staudinger', 'is_correct' => false],
                    ['option' => 'Robert H. Grubbs', 'is_correct' => false],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<p class="MsoNormal">Which Nobel laureate in chemistry is known for his work on
            the synthesis of complex natural products and the discovery of the structure of
            DNA, alongside Francis Crick and Rosalind Franklin?<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Paul J. Flory', 'is_correct' => false],
                    ['option' => 'Robert F. Curl Jr.', 'is_correct' => false],
                    ['option' => 'Linus Pauling', 'is_correct' => false],
                    ['option' => 'James D. Watson', 'is_correct' => true],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<span style="font-size:11.0pt;line-height:115%;
            font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
            &quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
            mso-bidi-language:AR-SA">Who was the chemist responsible for isolating and
            characterizing the element fluorine and making significant contributions to the
            field of organofluorine chemistry?</span><br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Antoine Lavoisier', 'is_correct' => true],
                    ['option' => 'Humphry Davy', 'is_correct' => false],
                    ['option' => 'Henri Moissan', 'is_correct' => false],
                    ['option' => 'Robert H. Grubbs', 'is_correct' => false],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<p class="MsoNormal">Who is known for the discovery of the structure of DNA and
            is famous for the double helix model, a fundamental contribution to the
            understanding of genetics and biochemistry?<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Francis Crick', 'is_correct' => false],
                    ['option' => 'Linus Pauling', 'is_correct' => false],
                    ['option' => 'James D. Watson', 'is_correct' => true],
                    ['option' => 'Rosalind Franklin', 'is_correct' => false],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<p class="MsoNormal">What is the name of the reaction that converts an ester and
            an alcohol into a carboxylic acid and another alcohol, often used in the
            synthesis of soap?<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Hydrolysis', 'is_correct' => true],
                    ['option' => 'Dehydration', 'is_correct' => false],
                    ['option' => 'Esterification', 'is_correct' => false],
                    ['option' => 'Oxidation', 'is_correct' => false],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<p class="MsoNormal">Who is the American chemist known for his contributions to
            the development of metathesis reactions, which have important applications in
            the synthesis of complex organic molecules?<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Wallace Carothers', 'is_correct' => false],
                    ['option' => 'Paul J. Flory', 'is_correct' => false],
                    ['option' => 'Robert H. Grubbs', 'is_correct' => true],
                    ['option' => 'Robert F. Curl Jr.', 'is_correct' => false],
                ],
            ],
            [
              'exam_id' => 2,
                'question' => '<span style="font-size:11.0pt;line-height:115%;
            font-family:&quot;Calibri&quot;,&quot;sans-serif&quot;;mso-fareast-font-family:SimSun;mso-bidi-font-family:
            &quot;Times New Roman&quot;;mso-ansi-language:EN-US;mso-fareast-language:ZH-CN;
            mso-bidi-language:AR-SA">What is the name of the reaction that converts an
            alcohol into an alkene by the removal of water, often used in the production of
            ethylene?</span><br>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'Dehydration', 'is_correct' => true],
                    ['option' => 'Hydrogenation', 'is_correct' => false],
                    ['option' => 'Oxidation', 'is_correct' => false],
                    ['option' => 'Esterification', 'is_correct' => false],
                ],
            ],

            // TODO: General
            [
                'exam_id' => 5,
                'question' => 'One of the following is considered to be part of environmental problems in Nigeria<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Noncompliance to the rule of law', 'is_correct' => false],
                    ['option' => 'Military intervention', 'is_correct' => false],
                    ['option' => 'Abuse of power', 'is_correct' => false],
                    ['option' => 'Deforestation', 'is_correct' => true],
                ],
            ],

            [
                'exam_id' => 5,
                'question' => 'All the following are environmental problems except on<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Planting', 'is_correct' => true],
                    ['option' => 'Soil erosion', 'is_correct' => false],
                    ['option' => 'Dumping of Wasted product', 'is_correct' => false],
                    ['option' => 'Oil pollution', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'The greatest threats of the forest in Nigeria have been<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Maintenance of wild life', 'is_correct' => false],
                    ['option' => 'Excess rain fall', 'is_correct' => false],
                    ['option' => 'Bush burning', 'is_correct' => true],
                    ['option' => 'Lack of forest policy', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'A peoples� perception of the world is as result of their<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Life', 'is_correct' => false],
                    ['option' => 'Ideas', 'is_correct' => false],
                    ['option' => 'World', 'is_correct' => false],
                    ['option' => 'Practical observation', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => '<div>Various ideas are put together to give us a picture of Nigerians perception of ____</div><div><br></div>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'The world', 'is_correct' => true],
                    ['option' => 'Africa', 'is_correct' => false],
                    ['option' => 'The noon', 'is_correct' => false],
                    ['option' => 'Heaven', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'In many Nigeria languages, the name given to God normally _____him as creator<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Portray', 'is_correct' => true],
                    ['option' => 'Recognizes', 'is_correct' => false],
                    ['option' => 'Qualifies', 'is_correct' => false],
                    ['option' => 'All of the above', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Self-reliance according to August(_____) implies a decision by oneself<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '1928', 'is_correct' => false],
                    ['option' => '1929', 'is_correct' => false],
                    ['option' => '1979', 'is_correct' => true],
                    ['option' => '1980', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => '<div>country is said to be self-reliance if the following criteria</div><div>is met except one</div>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Educational balanced', 'is_correct' => false],
                    ['option' => 'Economically sound', 'is_correct' => false],
                    ['option' => 'Inability to feed her citizen', 'is_correct' => true],
                    ['option' => 'Politically stable', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'The following are characteristics features of self-reliance<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Competence', 'is_correct' => false],
                    ['option' => 'Confidence', 'is_correct' => false],
                    ['option' => 'Originality', 'is_correct' => false],
                    ['option' => 'All of the above', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'The heavenly part is the home of the following except one<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'The stars', 'is_correct' => false],
                    ['option' => 'Ocean', 'is_correct' => true],
                    ['option' => 'Sun', 'is_correct' => false],
                    ['option' => 'Moon', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'The unification of both northern and southern protectorates is called ___<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Unity in diversity', 'is_correct' => false],
                    ['option' => 'Amalgamation', 'is_correct' => true],
                    ['option' => 'United Nigeria', 'is_correct' => false],
                    ['option' => 'Nigeria as a nation', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => '<div>The following clans can be located in the savannah zone of</div><div>Nigeria except one</div>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Nose', 'is_correct' => false],
                    ['option' => 'Hausa', 'is_correct' => false],
                    ['option' => 'Ijaw', 'is_correct' => true],
                    ['option' => 'Gwari', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'What is cultural pattern?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Cultural features', 'is_correct' => false],
                    ['option' => 'Acculturation', 'is_correct' => false],
                    ['option' => 'Enculturation', 'is_correct' => false],
                    ['option' => 'Mode of conduct and behaviour', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'In your own opinion, do you think corruption is an important value in Nigeria society<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'True', 'is_correct' => false],
                    ['option' => 'False', 'is_correct' => true],
                    ['option' => 'None of the above', 'is_correct' => false],
                    ['option' => 'All of the above', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Listed below are four components of culture except<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Economic system', 'is_correct' => false],
                    ['option' => 'Belief system', 'is_correct' => false],
                    ['option' => 'Kinship system', 'is_correct' => true],
                    ['option' => 'Political system', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Language determines perception and shape the world view of people<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'True', 'is_correct' => true],
                    ['option' => 'False', 'is_correct' => false],
                    ['option' => 'None of the above', 'is_correct' => false],
                    ['option' => 'All of the above', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Language determines perception and shape the world view of people Of<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Language', 'is_correct' => false],
                    ['option' => 'Symbol', 'is_correct' => true],
                    ['option' => 'Tradition', 'is_correct' => false],
                    ['option' => 'Culture', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => '<div>Knowledge</div><div>_____is one of the Greek philosophers that preaches justice</div>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Socrates', 'is_correct' => true],
                    ['option' => 'Adamu', 'is_correct' => false],
                    ['option' => 'Peter', 'is_correct' => false],
                    ['option' => 'Isiah', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'The following ethnic group can be traced to the forest zone except one<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Hausa', 'is_correct' => true],
                    ['option' => 'Igbo', 'is_correct' => false],
                    ['option' => 'Yoruba', 'is_correct' => false],
                    ['option' => 'Ekitis', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'General Yakubu Gowom (Rt) created ____ states in Nigeria<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '14', 'is_correct' => false],
                    ['option' => '12', 'is_correct' => true],
                    ['option' => '36', 'is_correct' => false],
                    ['option' => '18', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'No culture is superior to the other since each is adapted to its own<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Technology', 'is_correct' => false],
                    ['option' => 'Purpose', 'is_correct' => false],
                    ['option' => 'Environment', 'is_correct' => true],
                    ['option' => 'Culture', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Culture is a system of knowledge more or less shared by the member of a __<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Household', 'is_correct' => false],
                    ['option' => 'Society', 'is_correct' => true],
                    ['option' => 'Extended family', 'is_correct' => false],
                    ['option' => 'Nuclear famil', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Nok culture is so far the oldest iron working in ____<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'West Africa', 'is_correct' => true],
                    ['option' => 'African', 'is_correct' => false],
                    ['option' => 'Nigeria', 'is_correct' => false],
                    ['option' => 'Europe', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => ' <span style="color: rgb(33, 37, 41); font-size: 1rem; -webkit-tap-highlight-color: transparent; -webkit-option-size-adjust: 100%;">In the year _____ an object (Roped pot on a sand) was</span><div>unearthened by one Isiah Anozie in a village called Igbo-Ukwu</div>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '1927', 'is_correct' => false],
                    ['option' => '1928', 'is_correct' => false],
                    ['option' => '1930', 'is_correct' => false],
                    ['option' => '1938', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'All sort of abstraction design were made use of by the artist as the ornamentation of the surface. This statement is accredited to____<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Nok culture', 'is_correct' => false],
                    ['option' => 'Igbo-Ukwu', 'is_correct' => true],
                    ['option' => 'Ife culture', 'is_correct' => false],
                    ['option' => 'Benin culture', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'One of the characteristics of ____culture is that attention was not paid to human figure<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Ife', 'is_correct' => false],
                    ['option' => 'Igbo-Ukwu', 'is_correct' => true],
                    ['option' => 'Nupe', 'is_correct' => false],
                    ['option' => 'Benin', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Archaeological excavation with the prove of radiocarbon dating support the fact that the ancient city of Ille- Ife had been in existence before<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '500AD', 'is_correct' => false],
                    ['option' => '600AD', 'is_correct' => false],
                    ['option' => '700AD', 'is_correct' => false],
                    ['option' => '800AD', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'One of the function of culture is procreation. What is procreation?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'To procure', 'is_correct' => false],
                    ['option' => 'To recreate', 'is_correct' => false],
                    ['option' => 'To give birth', 'is_correct' => true],
                    ['option' => 'To manufacture', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Ife art came into limelight when a German Ethnologist, Leo Frobenius in ____excavated a good number of artifact<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '1905', 'is_correct' => false],
                    ['option' => '1910', 'is_correct' => true],
                    ['option' => '1915', 'is_correct' => false],
                    ['option' => '1920', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => '<div>Historical, ethnological and archaeological accounts of the ancient city of Ille-Ife showed that there was an</div><div>organized kingdom with substantial urban settlement with evidence of ____industries</div>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Food', 'is_correct' => false],
                    ['option' => 'Wood', 'is_correct' => false],
                    ['option' => 'Iron', 'is_correct' => false],
                    ['option' => 'Brass', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Culture is not genetically transmitted but rather it is ____<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Learned', 'is_correct' => true],
                    ['option' => 'Transferred', 'is_correct' => false],
                    ['option' => 'Transposed', 'is_correct' => false],
                    ['option' => 'Accumulated', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Culture changes in response to ___ needs and to ecological demands as evidence in the manner of dresses, hairstyle and pattern of behaviour of the people<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Society', 'is_correct' => true],
                    ['option' => 'Industry', 'is_correct' => false],
                    ['option' => 'People', 'is_correct' => false],
                    ['option' => 'Family', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'What is Ethnocentrism?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Superior culture', 'is_correct' => false],
                    ['option' => 'Inferior culture', 'is_correct' => false],
                    ['option' => 'Favour of the culture of ones own society', 'is_correct' => true],
                    ['option' => 'Diffusion of traits of culture', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Nok terracotta pieces was found deep in alluvial deposit accidentally through the activities of the Tin miners in<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => '1920', 'is_correct' => false],
                    ['option' => '1930', 'is_correct' => false],
                    ['option' => '1935', 'is_correct' => false],
                    ['option' => '1940', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'The method in which the Nok sculptures were produced is commonly referred too as<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Carving', 'is_correct' => false],
                    ['option' => 'Molding', 'is_correct' => false],
                    ['option' => 'Additive', 'is_correct' => true],
                    ['option' => 'Subtractive', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'The phonecians were noted sea traders and manufactures<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Bronze', 'is_correct' => true],
                    ['option' => 'Copper', 'is_correct' => false],
                    ['option' => 'Gold', 'is_correct' => false],
                    ['option' => 'Shells', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Double coincidence of wants means____<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'To locate buyers easily', 'is_correct' => false],
                    ['option' => 'Ready market to sell off items', 'is_correct' => false],
                    ['option' => 'Difficulty of bringing two people of different needs', 'is_correct' => true],
                    ['option' => 'Difficult in disposing goods', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'African culture exchange grains and other agricultural products such as the following except one<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Rice', 'is_correct' => false],
                    ['option' => 'Yam', 'is_correct' => false],
                    ['option' => 'Apple', 'is_correct' => true],
                    ['option' => 'Beans', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Listed below are factors that militate against the attainment of self-reliance except one<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Agriculture and food crisis', 'is_correct' => false],
                    ['option' => 'Education crisis', 'is_correct' => false],
                    ['option' => 'Food factor', 'is_correct' => false],
                    ['option' => 'Civilization', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Moral obligation of citizens according to Johnson (1988) is the standards of behaviour and duties which is perform by____<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Men', 'is_correct' => false],
                    ['option' => 'Women', 'is_correct' => false],
                    ['option' => 'Citizens', 'is_correct' => true],
                    ['option' => 'Children', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Most ethnic group in Nigeria were politically organized into empires and kingdom independent of one another. Listed below are some of the group except One<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Sokoto caliphate', 'is_correct' => false],
                    ['option' => 'Oyo empire', 'is_correct' => false],
                    ['option' => 'Ibibio Kingdom', 'is_correct' => true],
                    ['option' => 'Benin kingdom', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'The Hausa Fulani were noted ----- in the pre-colonial period<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Hunters and traders', 'is_correct' => false],
                    ['option' => 'Farmers and traders', 'is_correct' => false],
                    ['option' => 'Travelers', 'is_correct' => true],
                    ['option' => 'Fisher men', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'The Yoruba people lived in large town under the leadership of ____<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Chiefs', 'is_correct' => false],
                    ['option' => 'Obas', 'is_correct' => true],
                    ['option' => 'Obis', 'is_correct' => false],
                    ['option' => 'Ochefije', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Power is not ____distributed in Nigeria<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Equally', 'is_correct' => false],
                    ['option' => 'Equitably', 'is_correct' => true],
                    ['option' => 'Passionately', 'is_correct' => false],
                    ['option' => 'Rightly', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'The largest community that had not central authority before 1800 was the __<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Hausa', 'is_correct' => false],
                    ['option' => 'Igbo', 'is_correct' => true],
                    ['option' => 'Nupe', 'is_correct' => false],
                    ['option' => 'Bornu Empire', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'What right does the Nigeria constitution recognizes?<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Justice', 'is_correct' => false],
                    ['option' => 'Political', 'is_correct' => false],
                    ['option' => 'Judical', 'is_correct' => true],
                    ['option' => 'Social', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Trade by barter was the earliest form of____<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Business', 'is_correct' => false],
                    ['option' => 'Trade', 'is_correct' => true],
                    ['option' => 'Transaction', 'is_correct' => false],
                    ['option' => 'Occupation', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'The problem of barter led to the discovery of items that was regarded as currency such as the following Except <br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Shells', 'is_correct' => false],
                    ['option' => 'Bronze', 'is_correct' => false],
                    ['option' => 'Copper', 'is_correct' => false],
                    ['option' => 'currency note', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Which part of Nigeria resisted conquest<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Middle belt', 'is_correct' => false],
                    ['option' => 'Southern region', 'is_correct' => true],
                    ['option' => 'Northern region', 'is_correct' => false],
                    ['option' => 'Lokoja people', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Nigeria maintains a parallel system of traditional governance whichinclude_____<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Emirate council', 'is_correct' => false],
                    ['option' => 'Kinship council', 'is_correct' => false],
                    ['option' => 'Chieftaincy and emirates', 'is_correct' => true],
                    ['option' => 'Traditional council', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 5,
                'question' => 'Social justice is a condition where ____ exist<br>',
                'marks' => 1.2,
                'options' => [
                    ['option' => 'Opportunity and respect', 'is_correct' => false],
                    ['option' => 'Human dignity', 'is_correct' => false],
                    ['option' => 'Truth', 'is_correct' => false],
                    ['option' => 'Fairness, equal opportunity and respect for human dignity', 'is_correct' => true],
                ],
            ],


            //TODO: Use of English
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal"><span style="mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;
            mso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;"> Choose the option nearest in meaning to the underlined statement or words:</span><span style="mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;
            mso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;"><o:p></o:p></span></p><p class="MsoNormal"><span style="mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;
            mso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;">Had she asked me earlier, i might have been able to employ him</span><span style="mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;
            mso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;"><o:p></o:p></span></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'i employed her', 'is_correct' => false],
                    ['option' => 'i did not employ him', 'is_correct' => true],
                    ['option' => 'i did not employ her', 'is_correct' => false],
                    ['option' => ' i employed him', 'is_correct' => false],
                    ['option' => 'i employ neither of the two', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal"><span style="mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;
            mso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;">Choose the option nearest in meaning to the underlined statement or words:</span><span style="mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;
            mso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;"><o:p></o:p></span></p><p class="MsoNormal"><span style="mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;
            mso-bidi-font-family:\'Times New Roman\';font-size:11.0000pt;">If he were to apologize i would probably forgive him</span></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'i shall not forgive him even if he apologize', 'is_correct' => false],
                    ['option' => 'he is likely to apologize and be forgiven', 'is_correct' => false],
                    ['option' => 'i shall definitely forgive him if he apologizes', 'is_correct' => false],
                    ['option' => ' if he apologize i shall decide whether or not to forgive him', 'is_correct' => true],
                    ['option' => ' he will not apologize and i will not forgive him', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal">Choose the option nearest in meaning to the
            underlined words :<o:p></o:p></p>

            <p class="MsoNormal"><o:p> </o:p></p>

            <p class="MsoNormal">As he was a gullible leader his followers took advantage of
            him<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'He was weak and unable to enforce his authority', 'is_correct' => false],
                    ['option' => 'He was partial and unfair in dispensing justice', 'is_correct' => false],
                    ['option' => 'He was simple minded to a fault', 'is_correct' => true],
                    ['option' => 'He was slow to act', 'is_correct' => false],
                    ['option' => 'He was lacking in education and experience in everyday affair', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal"> Choose the
            option nearest in meaning to the underlined words :<o:p></o:p></p>

            <p class="MsoNormal">His summary of the meeting was BRIEF AND TO THE POINT.<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'careful', 'is_correct' => false],
                    ['option' => 'precise', 'is_correct' => true],
                    ['option' => 'accurate', 'is_correct' => false],
                    ['option' => 'exact', 'is_correct' => false],
                    ['option' => 'crucial', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal"> Choose the
            option nearest in meaning to the underlined words :<o:p></o:p></p>

            <p class="MsoNormal">Do you have the same AVERSION as i do for way
            film?<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'bitterness', 'is_correct' => false],
                    ['option' => 'dislike', 'is_correct' => true],
                    ['option' => 'criticism', 'is_correct' => false],
                    ['option' => 'indignation', 'is_correct' => false],
                    ['option' => 'preference', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal"> Choose the
            option nearest in meaning to the underlined words :<o:p></o:p></p>

            <p class="MsoNormal">I didn\'t think she could be so easily TAKEN IN by his
            pretences<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'flattered', 'is_correct' => false],
                    ['option' => 'deceived', 'is_correct' => true],
                    ['option' => 'enamoured', 'is_correct' => false],
                    ['option' => 'overcome', 'is_correct' => false],
                    ['option' => 'blackmailed', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal"> Choose the
            option nearest in meaning to the underlined words :<o:p></o:p></p>

            <p class="MsoNormal">The CRUX OF THE MATTER is that the president has
            just become aware of the mismanagement<o:p></o:p></p>

            <p class="MsoNormal"><o:p> </o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'The part of the problem that has just surfaced', 'is_correct' => false],
                    ['option' => 'The result of the matter', 'is_correct' => false],
                    ['option' => 'The most important aspect of the problem', 'is_correct' => true],
                    ['option' => 'The ways to solved the problem', 'is_correct' => false],
                    ['option' => 'The moment of crisis', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal"> Fill in the blank
            spaces in the following sentences making use of the best of the five options<o:p></o:p></p>

            <p class="MsoNormal">Olukayode .... as a mechanic when he was young, but now he
            is a driver<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'had been working', 'is_correct' => false],
                    ['option' => 'used to work', 'is_correct' => true],
                    ['option' => 'would work', 'is_correct' => false],
                    ['option' => 'would have worked', 'is_correct' => false],
                    ['option' => 'had worked', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal">Choose the option that best conveys the meaning of the
            underlined portion in the following sentence;<o:p></o:p></p>

            <p class="MsoNormal"><o:p> </o:p></p>

            <p class="MsoNormal">From the ways my friend talks, you can see he is such A
            BORE<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'rude', 'is_correct' => false],
                    ['option' => 'brilliant', 'is_correct' => false],
                    ['option' => 'uninteresting', 'is_correct' => true],
                    ['option' => 'overbearing', 'is_correct' => false],
                    ['option' => 'humorous', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal">Choose the option that best conveys the meaning of the
            underlined portion in the following sentence;<o:p></o:p></p><p class="MsoNormal"><o:p> </o:p></p><p class="MsoNormal">

            </p><p class="MsoNormal">The LEADER in today\'s issue of our popular
            newspaper focuses on inflation<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'president', 'is_correct' => false],
                    ['option' => 'headline', 'is_correct' => false],
                    ['option' => 'editorial', 'is_correct' => true],
                    ['option' => 'columnist', 'is_correct' => false],
                    ['option' => 'proprietor', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal">Choose the option that best conveys the meaning of the
            underlined portion in the following sentence;<o:p></o:p></p>

            <p class="MsoNormal"><o:p> </o:p></p>

            <p class="MsoNormal">He spoke with HIS HEART IN HIS MOUTH<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'courageously', 'is_correct' => false],
                    ['option' => 'with such unusual cowardice', 'is_correct' => false],
                    ['option' => 'with a lot of confusion in his speech', 'is_correct' => false],
                    ['option' => 'without being able to make up his mind', 'is_correct' => false],
                    ['option' => 'with fright and agitation', 'is_correct' => true],
                ],
            ],
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal">Choose the option that best conveys the meaning of the
            underlined portion in the following sentence;<o:p></o:p></p>

            <p class="MsoNormal"><o:p> </o:p></p>

            <p class="MsoNormal">When the man was caught by police he presented a bold
            front<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'he attacked the policemen boldly', 'is_correct' => false],
                    ['option' => 'he walked up to the policemen', 'is_correct' => false],
                    ['option' => 'he faced the situation with apparent boldness', 'is_correct' => true],
                    ['option' => 'he bravely attempted to give them a present', 'is_correct' => false],
                    ['option' => 'he frowned at them in a defiant manner', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal">Complete each of the following sentences by choosing the
            option that most suitably fills the space;<o:p></o:p></p>

            <p class="MsoNormal"><o:p> </o:p></p>

            <p class="MsoNormal">When the beggar was tired he ..... down by the roadside<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'lied', 'is_correct' => false],
                    ['option' => 'lied', 'is_correct' => false],
                    ['option' => 'layed', 'is_correct' => false],
                    ['option' => 'lay', 'is_correct' => true],
                    ['option' => 'lain', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal">Complete each of the following sentences by choosing the
            option that most suitably fills the space;<o:p></o:p></p>

            <p class="MsoNormal">He did not like .... leaving the class early<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'we', 'is_correct' => false],
                    ['option' => 'us', 'is_correct' => true],
                    ['option' => 'our', 'is_correct' => false],
                    ['option' => 'ourselves', 'is_correct' => false],
                    ['option' => 'our selves', 'is_correct' => false],
                ],
            ],
            [
                'exam_id' => 3,
                'question' => '<p class="MsoNormal">Complete each of the following sentences by choosing the
            option that most suitably fills the space;<o:p></o:p></p>

            <p class="MsoNormal"><o:p> </o:p></p>

            <p class="MsoNormal">Before the operation, the dentist found that his patient\'s
            teeth....<o:p></o:p></p>',
                'marks' => 1.0,
                'options' => [
                    ['option' => 'have long decayed', 'is_correct' => false],
                    ['option' => 'have long been decayed', 'is_correct' => false],
                    ['option' => 'have long being decayed', 'is_correct' => false],
                    ['option' => 'had long decayed', 'is_correct' => true],
                    ['option' => 'had been decayed', 'is_correct' => false],
                ],
            ],
        ];

        foreach ($questions as $question) {

            $newQuestion = Question::updateOrCreate([
                'question' => $question['question'],
            ], [
                'exam_id' => $question['exam_id'],
                'question' => $question['question'],
                'marks' => $question['marks'],
            ]);

            foreach ($question['options'] as $option) {
                QuestionOption::updateOrCreate([
                    'question_id' => $newQuestion->id,
                    'option' => $option['option'],
                ], $option);
            }
        }
    }
}
