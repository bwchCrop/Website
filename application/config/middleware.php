<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Define all user that can access display attendances pages
 */

$config = [
    'middleware_user' => [
        [
            'unit' => 'Saharjo',
            'branch_name' => 'SAHARJO',
            'username' => 'bagsaharjo',
            'password' => 'bagsaharjo123'
        ],
        [
            'unit' => 'Duren Tiga',
            'branch_name' => 'DUREN TIGA',
            'username' => 'bagdurentiga',
            'password' => 'bagdurentiga123'
        ],
        [
             'unit' => 'Antasari',
             'branch_name' => 'ANTASARI',
             'username' => 'bagantasari',
             'password' => 'bagantasari123'
        ],
        [
             'unit' => 'Depok',
             'branch_name' => 'DEPOK',
             'username' => 'bagdepok',
             'password' => 'bagdepok123'
        ],
        [
             'unit' => 'Tangerang',
             'branch_name' => 'TANGERANG',
             'username' => 'bagtangerang',
             'password' => 'bagtangerang123'
        ],
        [
             'unit' => 'Bandung',
             'branch_name' => 'BANDUNG',
             'username' => 'bagbandung',
             'password' => 'bagbandung123'
        ],
        [
             'unit' => 'Kemang',
             'branch_name' => 'KEMANG',
             'username' => 'bagkemang',
             'password' => 'bagkemang123'
        ],
    ]
];
