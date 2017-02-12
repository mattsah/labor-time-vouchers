<?php


$goods  = array();
$rtimes = array();

foreach (glob(__DIR__ . '/goods/*.php') as $good) {
    $name         = basename($good, '.php');
    $goods[$name] = include($good);
}

foreach ($goods as $name => $good) {
    echo sprintf(
        'The rtime for "%s" is %f, we have %d units',
        $good['name'],
        $good['rtime'],
        $good['total']
    ) . PHP_EOL;
}

echo PHP_EOL;

while(true) {
    foreach ($goods as $name => $good) {
        $rtimes[$name] = $good['rtime'];
    }

    foreach ($goods as $name => $good) {
        $rtime = $good['labor'];

        foreach ($good['goods'] as $mop => $quantity) {
            if ($quantity > $goods[$mop]['total']) {
                throw new Exception(sprintf(
                    'Production cannot continue, not enough units of "%s", requires +%s',
                    $goods[$mop]['name'],
                    $quantity - $goods[$mop]['total']
                ));

            } else {
                $goods[$mop]['total'] = $goods[$mop]['total'] - $quantity;
            }

            $rtime = $rtime + ($goods[$mop]['rtime'] * $quantity);
        }

        $goods[$name]['rtime'] = $rtime / $good['count'];
        $goods[$name]['total'] = $good['total'] + $good['count'];
    }

    foreach ($goods as $name => $good) {
        if ($rtimes[$name] != $good['rtime']) {
            continue 2;
        }
    }

    break;
}

foreach ($goods as $name => $good) {
    echo sprintf(
        'The rtime for "%s" is %f, we have %d units',
        $good['name'],
        $good['rtime'],
        $good['total']
    ) . PHP_EOL;
}
