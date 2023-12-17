<?php

namespace App\RolePlay\Const;

/**
 * @link https://5e-drs.fr/systeme-monetaire/
 */
const MoneyMatrice = [
    // PC	PA	PE	PO	PP
    /*PC*/   [1, 1 / 10, 1 / 50, 1 / 100, 1 / 1000,],
    /*PA*/  [10, 1, 1 / 5, 1 / 10, 1 / 100,],
    /*PE*/   [50, 5, 1, 1 / 2, 1 / 20,],
    /*PO*/  [100, 10, 2, 1, 1 / 10,],
    /*PP*/ [1000, 100, 20, 10, 1],
];
