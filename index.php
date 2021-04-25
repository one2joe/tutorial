<?php
$start = '2021-04-17 23:50';
$end = '2021-04-18 11:30';

function hourDist ($start, $end) {
	$result = [];
	$hourStartRange = floor(strtotime($start) / 3600);
	$hourEndRange = floor((strtotime($end) - 0.0001) / 3600);
	for ($v = $hourStartRange; $v <= $hourEndRange; $v++) {
		$hStart = strtotime($start) > (($v) * 3600) ? strtotime($start) : ($v) * 3600;
		$hEnd = strtotime($end) < ($v + 1) * 3600 ? strtotime($end) : ($v + 1) * 3600;
		$result[] = [
			'hStart' => DateTime::createFromFormat('U' ,$hStart)->format('Y-m-d H:i'),
			'hEnd' => DateTime::createFromFormat('U' ,$hEnd)->format('Y-m-d H:i'),
			'diff' => $hEnd - $hStart,
		];
	}
	return  $result;
}

$cost = ['site' => "ANC1603",'subimpact_tech_name' => "36850",'subimpact_data_name' => "CS",'subimpact_event_name' => "WEEKEND",'hr0' => "7",'hr1' => "3",'hr2' => "2.5",'hr3' => "3.5",'hr4' => "6",'hr5' => "9",'hr6' => "43",'hr7' => "56",'hr17' => "90.5",'hr18' => "70",'hr19' => "38.5",'hr20' => "6.5",'hr21' => "19",'hr22' => "4.5",'hr23' => "6.5",];

function hourDistCost ($start, $end, $cost) {
	$times = hourDist($start, $end);
	foreach ($times as $k => $v) {
		$h = DateTime::createFromFormat('Y-m-d H:i', $v['hStart'])->format('G');
		$times[$k]['price'] = $v['diff'] * (empty($cost["hr{$h}"]) ? 0 : $cost["hr{$h}"]) / 3600;
	}
	return $times;
}

$result = hourDistCost($start, $end, $cost);
exit;