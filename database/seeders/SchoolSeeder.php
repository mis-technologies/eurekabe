<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Common\Models\School;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        $schools = [
            // ── Federal Universities ──────────────────────────────────────────────
            ['name' => 'University of Lagos',                              'acronym' => 'UNILAG',    'city' => 'Lagos',          'state' => 'Lagos',        'type' => 'federal'],
            ['name' => 'University of Ibadan',                             'acronym' => 'UI',        'city' => 'Ibadan',         'state' => 'Oyo',          'type' => 'federal'],
            ['name' => 'Obafemi Awolowo University',                       'acronym' => 'OAU',       'city' => 'Ile-Ife',        'state' => 'Osun',         'type' => 'federal'],
            ['name' => 'University of Nigeria',                            'acronym' => 'UNN',       'city' => 'Nsukka',         'state' => 'Enugu',        'type' => 'federal'],
            ['name' => 'Ahmadu Bello University',                          'acronym' => 'ABU',       'city' => 'Zaria',          'state' => 'Kaduna',       'type' => 'federal'],
            ['name' => 'University of Benin',                              'acronym' => 'UNIBEN',    'city' => 'Benin City',     'state' => 'Edo',          'type' => 'federal'],
            ['name' => 'Nnamdi Azikiwe University',                        'acronym' => 'UNIZIK',    'city' => 'Awka',           'state' => 'Anambra',      'type' => 'federal'],
            ['name' => 'Bayero University Kano',                           'acronym' => 'BUK',       'city' => 'Kano',           'state' => 'Kano',         'type' => 'federal'],
            ['name' => 'University of Ilorin',                             'acronym' => 'UNILORIN',  'city' => 'Ilorin',         'state' => 'Kwara',        'type' => 'federal'],
            ['name' => 'University of Jos',                                'acronym' => 'UNIJOS',    'city' => 'Jos',            'state' => 'Plateau',      'type' => 'federal'],
            ['name' => 'University of Maiduguri',                          'acronym' => 'UNIMAID',   'city' => 'Maiduguri',      'state' => 'Borno',        'type' => 'federal'],
            ['name' => 'University of Port Harcourt',                      'acronym' => 'UNIPORT',   'city' => 'Port Harcourt',  'state' => 'Rivers',       'type' => 'federal'],
            ['name' => 'University of Calabar',                            'acronym' => 'UNICAL',    'city' => 'Calabar',        'state' => 'Cross River',  'type' => 'federal'],
            ['name' => 'University of Uyo',                                'acronym' => 'UNIUYO',    'city' => 'Uyo',            'state' => 'Akwa Ibom',    'type' => 'federal'],
            ['name' => 'University of Abuja',                              'acronym' => 'UNIABUJA',  'city' => 'Abuja',          'state' => 'FCT',          'type' => 'federal'],
            ['name' => 'Usmanu Danfodiyo University',                      'acronym' => 'UDUS',      'city' => 'Sokoto',         'state' => 'Sokoto',       'type' => 'federal'],

            // Federal Universities of Technology
            ['name' => 'Federal University of Technology Akure',           'acronym' => 'FUTA',      'city' => 'Akure',          'state' => 'Ondo',         'type' => 'federal'],
            ['name' => 'Federal University of Technology Minna',           'acronym' => 'FUTMINNA',  'city' => 'Minna',          'state' => 'Niger',        'type' => 'federal'],
            ['name' => 'Federal University of Technology Owerri',          'acronym' => 'FUTO',      'city' => 'Owerri',         'state' => 'Imo',          'type' => 'federal'],
            ['name' => 'Modibbo Adama University of Technology',           'acronym' => 'MAUTECH',   'city' => 'Yola',           'state' => 'Adamawa',      'type' => 'federal'],

            // Federal Universities of Agriculture
            ['name' => 'Federal University of Agriculture Makurdi',        'acronym' => 'FUAM',      'city' => 'Makurdi',        'state' => 'Benue',        'type' => 'federal'],
            ['name' => 'Federal University of Agriculture Abeokuta',       'acronym' => 'FUNAAB',    'city' => 'Abeokuta',       'state' => 'Ogun',         'type' => 'federal'],
            ['name' => 'Federal University of Agriculture Zuru',           'acronym' => 'FUAZURU',   'city' => 'Zuru',           'state' => 'Kebbi',        'type' => 'federal'],

            // Newer Federal Universities
            ['name' => 'Federal University Dutse',                         'acronym' => 'FUD',       'city' => 'Dutse',          'state' => 'Jigawa',       'type' => 'federal'],
            ['name' => 'Federal University Dutsin-Ma',                     'acronym' => 'FUDMA',     'city' => 'Dutsin-Ma',      'state' => 'Katsina',      'type' => 'federal'],
            ['name' => 'Federal University Gashua',                        'acronym' => 'FUGASHUA',  'city' => 'Gashua',         'state' => 'Yobe',         'type' => 'federal'],
            ['name' => 'Federal University Lafia',                         'acronym' => 'FULAFIA',   'city' => 'Lafia',          'state' => 'Nasarawa',     'type' => 'federal'],
            ['name' => 'Federal University Lokoja',                        'acronym' => 'FULOKOJA',  'city' => 'Lokoja',         'state' => 'Kogi',         'type' => 'federal'],
            ['name' => 'Federal University Ndufu-Alike Ikwo',              'acronym' => 'FUNAI',     'city' => 'Afikpo',         'state' => 'Ebonyi',       'type' => 'federal'],
            ['name' => 'Federal University Otuoke',                        'acronym' => 'FUO',       'city' => 'Otuoke',         'state' => 'Bayelsa',      'type' => 'federal'],
            ['name' => 'Federal University Oye-Ekiti',                     'acronym' => 'FUOYE',     'city' => 'Oye-Ekiti',      'state' => 'Ekiti',        'type' => 'federal'],
            ['name' => 'Federal University Wukari',                        'acronym' => 'FUW',       'city' => 'Wukari',         'state' => 'Taraba',       'type' => 'federal'],
            ['name' => 'Federal University Birnin Kebbi',                  'acronym' => 'FUBK',      'city' => 'Birnin Kebbi',   'state' => 'Kebbi',        'type' => 'federal'],
            ['name' => 'Federal University Kashere',                       'acronym' => 'FUKASHERE', 'city' => 'Kashere',        'state' => 'Gombe',        'type' => 'federal'],
            ['name' => 'Federal University Gusau',                         'acronym' => 'FUGUS',     'city' => 'Gusau',          'state' => 'Zamfara',      'type' => 'federal'],
            ['name' => 'Federal University Katsina',                       'acronym' => 'FUKA',      'city' => 'Katsina',        'state' => 'Katsina',      'type' => 'federal'],
            ['name' => 'National Open University of Nigeria',               'acronym' => 'NOUN',      'city' => 'Abuja',          'state' => 'FCT',          'type' => 'federal'],
            ['name' => 'Nigerian Defence Academy',                         'acronym' => 'NDA',       'city' => 'Kaduna',         'state' => 'Kaduna',       'type' => 'federal'],
            ['name' => 'Air Force Institute of Technology',                'acronym' => 'AFIT',      'city' => 'Kaduna',         'state' => 'Kaduna',       'type' => 'federal'],
            ['name' => 'Nigerian Police Academy',                          'acronym' => 'POLAC',     'city' => 'Wudil',          'state' => 'Kano',         'type' => 'federal'],

            // ── State Universities ────────────────────────────────────────────────
            ['name' => 'Lagos State University',                           'acronym' => 'LASU',      'city' => 'Ojo',            'state' => 'Lagos',        'type' => 'state'],
            ['name' => 'Rivers State University',                          'acronym' => 'RSU',       'city' => 'Port Harcourt',  'state' => 'Rivers',       'type' => 'state'],
            ['name' => 'Ambrose Alli University',                          'acronym' => 'AAU',       'city' => 'Ekpoma',         'state' => 'Edo',          'type' => 'state'],
            ['name' => 'Imo State University',                             'acronym' => 'IMSU',      'city' => 'Owerri',         'state' => 'Imo',          'type' => 'state'],
            ['name' => 'Delta State University',                           'acronym' => 'DELSU',     'city' => 'Abraka',         'state' => 'Delta',        'type' => 'state'],
            ['name' => 'Abia State University',                            'acronym' => 'ABSU',      'city' => 'Uturu',          'state' => 'Abia',         'type' => 'state'],
            ['name' => 'Adamawa State University',                         'acronym' => 'ADSU',      'city' => 'Mubi',           'state' => 'Adamawa',      'type' => 'state'],
            ['name' => 'Akwa Ibom State University',                       'acronym' => 'AKSU',      'city' => 'Obio Akpa',      'state' => 'Akwa Ibom',    'type' => 'state'],
            ['name' => 'Cross River University of Technology',             'acronym' => 'CRUTECH',   'city' => 'Calabar',        'state' => 'Cross River',  'type' => 'state'],
            ['name' => 'Ebonyi State University',                          'acronym' => 'EBSU',      'city' => 'Abakaliki',      'state' => 'Ebonyi',       'type' => 'state'],
            ['name' => 'Ekiti State University',                           'acronym' => 'EKSU',      'city' => 'Ado-Ekiti',      'state' => 'Ekiti',        'type' => 'state'],
            ['name' => 'Kogi State University',                            'acronym' => 'KSU',       'city' => 'Anyigba',        'state' => 'Kogi',         'type' => 'state'],
            ['name' => 'Kwara State University',                           'acronym' => 'KWASU',     'city' => 'Malete',         'state' => 'Kwara',        'type' => 'state'],
            ['name' => 'Nasarawa State University',                        'acronym' => 'NSUK',      'city' => 'Keffi',          'state' => 'Nasarawa',     'type' => 'state'],
            ['name' => 'Niger Delta University',                           'acronym' => 'NDU',       'city' => 'Wilberforce Island', 'state' => 'Bayelsa',  'type' => 'state'],
            ['name' => 'Olabisi Onabanjo University',                      'acronym' => 'OOU',       'city' => 'Ago-Iwoye',      'state' => 'Ogun',         'type' => 'state'],
            ['name' => 'Osun State University',                            'acronym' => 'UNIOSUN',   'city' => 'Osogbo',         'state' => 'Osun',         'type' => 'state'],
            ['name' => 'Plateau State University',                         'acronym' => 'PLASU',     'city' => 'Bokkos',         'state' => 'Plateau',      'type' => 'state'],
            ['name' => 'Sokoto State University',                          'acronym' => 'SSU',       'city' => 'Sokoto',         'state' => 'Sokoto',       'type' => 'state'],
            ['name' => 'Taraba State University',                          'acronym' => 'TSU',       'city' => 'Jalingo',        'state' => 'Taraba',       'type' => 'state'],
            ['name' => 'Yobe State University',                            'acronym' => 'YSU',       'city' => 'Damaturu',       'state' => 'Yobe',         'type' => 'state'],
            ['name' => 'Zamfara State University',                         'acronym' => 'ZAMSU',     'city' => 'Talata-Mafara',  'state' => 'Zamfara',      'type' => 'state'],
            ['name' => 'Gombe State University',                           'acronym' => 'GSU',       'city' => 'Tudun Wada',     'state' => 'Gombe',        'type' => 'state'],
            ['name' => 'Borno State University',                           'acronym' => 'BOSU',      'city' => 'Maiduguri',      'state' => 'Borno',        'type' => 'state'],
            ['name' => 'Kebbi State University of Science and Technology', 'acronym' => 'KSUSTA',    'city' => 'Aliero',         'state' => 'Kebbi',        'type' => 'state'],
            ['name' => 'Kaduna State University',                          'acronym' => 'KASU',      'city' => 'Kaduna',         'state' => 'Kaduna',       'type' => 'state'],
            ['name' => 'Ibrahim Badamasi Babangida University',            'acronym' => 'IBBU',      'city' => 'Lapai',          'state' => 'Niger',        'type' => 'state'],
            ['name' => 'Benue State University',                           'acronym' => 'BSU',       'city' => 'Makurdi',        'state' => 'Benue',        'type' => 'state'],
            ['name' => 'Adekunle Ajasin University',                       'acronym' => 'AAUA',      'city' => 'Akungba-Akoko',  'state' => 'Ondo',         'type' => 'state'],
            ['name' => 'Tai Solarin University of Education',              'acronym' => 'TASUED',    'city' => 'Ijebu-Ode',      'state' => 'Ogun',         'type' => 'state'],
            ['name' => 'Lagos State University of Science and Technology', 'acronym' => 'LASUSTECH', 'city' => 'Ikorodu',        'state' => 'Lagos',        'type' => 'state'],
            ['name' => 'Chukwuemeka Odumegwu Ojukwu University',          'acronym' => 'COOU',      'city' => 'Uli',            'state' => 'Anambra',      'type' => 'state'],
            ['name' => 'Ignatius Ajuru University of Education',           'acronym' => 'IAUE',      'city' => 'Rumuolumeni',    'state' => 'Rivers',       'type' => 'state'],
            ['name' => 'University of Africa Toru-Orua',                   'acronym' => 'UA',        'city' => 'Toru-Orua',      'state' => 'Bayelsa',      'type' => 'state'],
            ['name' => 'Enugu State University of Science and Technology', 'acronym' => 'ESUT',      'city' => 'Enugu',          'state' => 'Enugu',        'type' => 'state'],
            ['name' => 'Anambra State University',                         'acronym' => 'ANSU',      'city' => 'Uli',            'state' => 'Anambra',      'type' => 'state'],
            ['name' => 'Kano State University of Technology',              'acronym' => 'KUST',      'city' => 'Wudil',          'state' => 'Kano',         'type' => 'state'],

            // ── Private Universities ───────────────────────────────────────────────
            ['name' => 'Covenant University',                              'acronym' => 'CU',        'city' => 'Ota',            'state' => 'Ogun',         'type' => 'private'],
            ['name' => 'Babcock University',                               'acronym' => 'BU',        'city' => 'Ilishan-Remo',   'state' => 'Ogun',         'type' => 'private'],
            ['name' => 'Pan-Atlantic University',                          'acronym' => 'PAU',       'city' => 'Lagos',          'state' => 'Lagos',        'type' => 'private'],
            ['name' => 'American University of Nigeria',                   'acronym' => 'AUN',       'city' => 'Yola',           'state' => 'Adamawa',      'type' => 'private'],
            ['name' => "Redeemer's University",                            'acronym' => 'RUN',       'city' => 'Ede',            'state' => 'Osun',         'type' => 'private'],
            ['name' => 'Afe Babalola University',                          'acronym' => 'ABUAD',     'city' => 'Ado-Ekiti',      'state' => 'Ekiti',        'type' => 'private'],
            ['name' => 'Landmark University',                              'acronym' => 'LMU',       'city' => 'Omu-Aran',       'state' => 'Kwara',        'type' => 'private'],
            ['name' => 'Bowen University',                                 'acronym' => 'BOWEN',     'city' => 'Iwo',            'state' => 'Osun',         'type' => 'private'],
            ['name' => 'Bells University of Technology',                   'acronym' => 'BUT',       'city' => 'Ota',            'state' => 'Ogun',         'type' => 'private'],
            ['name' => 'Baze University',                                  'acronym' => 'BAZE',      'city' => 'Abuja',          'state' => 'FCT',          'type' => 'private'],
            ['name' => 'Lead City University',                             'acronym' => 'LCU',       'city' => 'Ibadan',         'state' => 'Oyo',          'type' => 'private'],
            ['name' => 'Madonna University',                               'acronym' => 'MADONNAU',  'city' => 'Okija',          'state' => 'Anambra',      'type' => 'private'],
            ['name' => 'Al-Hikmah University',                             'acronym' => 'AHU',       'city' => 'Ilorin',         'state' => 'Kwara',        'type' => 'private'],
            ['name' => 'Fountain University',                              'acronym' => 'FUI',       'city' => 'Osogbo',         'state' => 'Osun',         'type' => 'private'],
            ['name' => 'Achievers University',                             'acronym' => 'ACHIVERS',  'city' => 'Owo',            'state' => 'Ondo',         'type' => 'private'],
            ['name' => 'Salem University',                                 'acronym' => 'SALEMUNIV', 'city' => 'Lokoja',         'state' => 'Kogi',         'type' => 'private'],
            ['name' => 'Caritas University',                               'acronym' => 'CARITAS',   'city' => 'Enugu',          'state' => 'Enugu',        'type' => 'private'],
            ['name' => 'Godfrey Okoye University',                         'acronym' => 'GOUNI',     'city' => 'Enugu',          'state' => 'Enugu',        'type' => 'private'],
            ['name' => 'Veritas University',                               'acronym' => 'VUA',       'city' => 'Abuja',          'state' => 'FCT',          'type' => 'private'],
            ['name' => 'Augustine University',                             'acronym' => 'AUGUSTINEU','city' => 'Epe',            'state' => 'Lagos',        'type' => 'private'],
            ['name' => 'Crawford University',                              'acronym' => 'CRAWFU',    'city' => 'Igbesa',         'state' => 'Ogun',         'type' => 'private'],
            ['name' => 'Novena University',                                'acronym' => 'NOVENAU',   'city' => 'Ogume',          'state' => 'Delta',        'type' => 'private'],
            ['name' => 'Caleb University',                                 'acronym' => 'CALEB',     'city' => 'Lagos',          'state' => 'Lagos',        'type' => 'private'],
            ['name' => 'University of Medical Sciences',                   'acronym' => 'UNIMED',    'city' => 'Ondo',           'state' => 'Ondo',         'type' => 'state'],
            ['name' => 'Southwestern University',                          'acronym' => 'SUN',       'city' => 'Okun-Owa',       'state' => 'Ogun',         'type' => 'private'],
            ['name' => 'Dominion University',                              'acronym' => 'DUI',       'city' => 'Ibadan',         'state' => 'Oyo',          'type' => 'private'],
            ['name' => 'Hezekiah University',                              'acronym' => 'HEZEKIAH',  'city' => 'Umudi',          'state' => 'Imo',          'type' => 'private'],
            ['name' => 'Westland University',                              'acronym' => 'WESTLAND',  'city' => 'Iwo',            'state' => 'Osun',         'type' => 'private'],
            ['name' => 'Wesley University of Science and Technology',      'acronym' => 'WUSTO',     'city' => 'Ondo',           'state' => 'Ondo',         'type' => 'private'],
            ['name' => 'Michael and Cecilia Ibru University',              'acronym' => 'MCIU',      'city' => 'Agbarha-Otor',   'state' => 'Delta',        'type' => 'private'],
            ['name' => 'Dominican University',                             'acronym' => 'DUN',       'city' => 'Ibadan',         'state' => 'Oyo',          'type' => 'private'],
            ['name' => 'Paul University',                                  'acronym' => 'PAULUNIV',  'city' => 'Awka',           'state' => 'Anambra',      'type' => 'private'],
            ['name' => 'Clifford University',                              'acronym' => 'CLIFFORD',  'city' => 'Owerrinta',      'state' => 'Abia',         'type' => 'private'],
            ['name' => 'Rhema University',                                 'acronym' => 'RHEMA',     'city' => 'Aba',            'state' => 'Abia',         'type' => 'private'],
            ['name' => 'Tansian University',                               'acronym' => 'TANSIAN',   'city' => 'Umunya',         'state' => 'Anambra',      'type' => 'private'],
            ['name' => 'Ajayi Crowther University',                        'acronym' => 'ACU',       'city' => 'Oyo',            'state' => 'Oyo',          'type' => 'private'],
            ['name' => 'Christopher University',                           'acronym' => 'CUN',       'city' => 'Mowe',           'state' => 'Ogun',         'type' => 'private'],
            ['name' => 'Hallmark University',                              'acronym' => 'HU',        'city' => 'Ijebu-Itele',    'state' => 'Ogun',         'type' => 'private'],
            ['name' => 'Kola Daisi University',                            'acronym' => 'KDU',       'city' => 'Ibadan',         'state' => 'Oyo',          'type' => 'private'],
            ['name' => 'Elizade University',                               'acronym' => 'EU',        'city' => 'Ilara-Mokin',    'state' => 'Ondo',         'type' => 'private'],
            ['name' => 'Adeleke University',                               'acronym' => 'ADELEKE',   'city' => 'Ede',            'state' => 'Osun',         'type' => 'private'],
            ['name' => 'Joseph Ayo Babalola University',                   'acronym' => 'JABU',      'city' => 'Ikeji-Arakeji',  'state' => 'Osun',         'type' => 'private'],
            ['name' => 'Crescent University',                              'acronym' => 'CUSIT',     'city' => 'Abeokuta',       'state' => 'Ogun',         'type' => 'private'],
            ['name' => 'McPherson University',                             'acronym' => 'MU',        'city' => 'Seriki-Sotayo',  'state' => 'Ogun',         'type' => 'private'],
            ['name' => 'Anchor University',                                'acronym' => 'AUL',       'city' => 'Lagos',          'state' => 'Lagos',        'type' => 'private'],
            ['name' => 'Edwin Clark University',                           'acronym' => 'ECU',       'city' => 'Kiagbodo',       'state' => 'Delta',        'type' => 'private'],
            ['name' => 'Samuel Adegboyega University',                     'acronym' => 'SAU',       'city' => 'Ogwa',           'state' => 'Edo',          'type' => 'private'],
            ['name' => 'Spiritan University',                              'acronym' => 'SUNU',      'city' => 'Nneochi',        'state' => 'Abia',         'type' => 'private'],
            ['name' => 'Gregory University',                               'acronym' => 'GLNU',      'city' => 'Uturu',          'state' => 'Abia',         'type' => 'private'],
            ['name' => 'Trinity University',                               'acronym' => 'TRINUNIV',  'city' => 'Lagos',          'state' => 'Lagos',        'type' => 'private'],
            ['name' => 'Precious Cornerstone University',                  'acronym' => 'PCU',       'city' => 'Ibadan',         'state' => 'Oyo',          'type' => 'private'],
        ];

        $count = 0;
        foreach ($schools as $data) {
            School::updateOrCreate(
                ['acronym' => $data['acronym']],
                array_merge($data, ['is_active' => 1]),
            );
            $count++;
        }

        $this->command->info("Schools seeded/updated: {$count}");
    }
}
