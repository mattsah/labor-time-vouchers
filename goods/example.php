<?php

//
// Please do not make anything actually rely on this good.  It's just an example for you to copy and add others.
//

return [
    'name'  => '1 Example Good',   // The name of the good, should express some measure in appropriate units, e.g. "1 Pound of Wheat"
    'total' => 10,                 // The total number of units currently available
    'count' => 13,                 // The total number of units produced with the given 'labor' and 'goods'
    'labor' => 20,                 // The total number of labor hours requires to produce 'count' number of units
    'rtime' => 6,                  // The initial estimated reproduction time per unit
    'goods' => [                   // An array containing the requisite Means of Production mapped to quantity required
        'steel' => 10,             // Example, to produce 13 ('count') units of 1 Example Good, we need 10 units of steel
    ]
];
