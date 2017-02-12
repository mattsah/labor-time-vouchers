<?php


$goods  = array();
$rtimes = array();

foreach (glob(__DIR__ . '/goods/*.php') as $good) {
    $name = basename($good, '.php');

    if ($name == 'example') {
        continue;
    }

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
    foreach (array_keys($goods) as $name) {
        $rtimes[$name] = $goods[$name]['rtime'];
    }

    foreach (array_keys($goods) as $name) {
        $rtime = $goods[$name]['labor'];

        foreach ($goods[$name]['goods'] as $mop => $quantity) {
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

        $goods[$name]['rtime'] = $rtime / $goods[$name]['count'];
        $goods[$name]['total'] = $goods[$name]['total'] + $goods[$name]['count'];
    }

    foreach (array_keys($goods) as $name) {
        if ($rtimes[$name] != $goods[$name]['rtime']) {
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
