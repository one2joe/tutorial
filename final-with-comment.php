<?php
// $start = '2021-04-17 23:51:21';
// $end = '2021-04-18 01:46:11';

// $start = '2021-04-18 23:51:21';
// $end = '2021-04-18 23:56:11';

// $start = '2021-04-17 23:00';
// $end = '2021-04-18 2:00';

$start = '2021-04-17 23:50';
$end = '2021-04-18 11:30';

function hourDist ($start, $end) {
	$result = [];
	// $result['$start'] = $start;
	// $result['$end'] = $end;
	// $result['secBefore'] = 3600 - strtotime($start) % 3600;
	// $result['secAfter'] = strtotime($end) % 3600;
	// $result['hourStartRange'] = floor(strtotime($start) / 3600);
	// $result['hourEndRange'] = floor ((strtotime($end) - 1) / 3600);
	$hourStartRange = floor(strtotime($start) / 3600);
	$hourEndRange = floor ((strtotime($end) - 1) / 3600);
	// $result['hourStartRangeFormat'] = DateTime::createFromFormat('U', floor(strtotime($start) / 3600) * 3600)->format("Y-m-d H:i:s");
	// $result['hourEndRangeFormat'] = DateTime::createFromFormat('U', floor (strtotime($end) / 3600) * 3600)->format("Y-m-d H:i:s");
	for ($v = $hourStartRange; $v <= $hourEndRange; $v++) {
		// $result['series'][] = $v;
		// $result['series'][] = DateTime::createFromFormat('U', $v * 3600)->format("Y-m-d H:i:s");
		$hStart = strtotime($start) > (($v) * 3600) ? strtotime($start) : ($v) * 3600;
		$hEnd = strtotime($end) < ($v + 1) * 3600 ? strtotime($end) : ($v + 1) * 3600;
		// $result['series'][] = [
		$result[] = [
			/* 'format' => DateTime::createFromFormat('U', $v * 3600)->format("Y-m-d H:i"),
			'start' => strtotime($start),
			'hStart' => ($v) * 3600,
			'isFirst' => strtotime($start) > (($v) * 3600) ? strtotime($start) : ($v) * 3600,
			'end' => strtotime($end),
			'hEnd' => ($v + 1) * 3600,
			'isLast' => strtotime($end) < ($v + 1) * 3600 ? strtotime($end) : ($v + 1) * 3600, */
			// 'hStartFormat' => DateTime::createFromFormat('U' ,$hStart)->format('Y-m-d H:i'),
			// 'hEndFormat' => DateTime::createFromFormat('U' ,$hEnd)->format('Y-m-d H:i'),
			'hStart' => DateTime::createFromFormat('U' ,$hStart)->format('Y-m-d H:i'),
			'hEnd' => DateTime::createFromFormat('U' ,$hEnd)->format('Y-m-d H:i'),
			'diff' => $hEnd - $hStart,
		];
	}
	return  $result;
}

print_r(hourDist($start, $end));

$cost = ['site' => "ANC1603",'subimpact_tech_name' => "36850",'subimpact_data_name' => "CS",'subimpact_event_name' => "WEEKEND",'hr0' => "7",'hr1' => "3",'hr2' => "2.5",'hr3' => "3.5",'hr4' => "6",'hr5' => "9",'hr6' => "43",'hr7' => "56",'hr17' => "90.5",'hr18' => "70",'hr19' => "38.5",'hr20' => "6.5",'hr21' => "19",'hr22' => "4.5",'hr23' => "6.5",];

function hourDistCost ($start, $end, $cost) {
	$times = hourDist($start, $end);
	foreach ($times as $k => $v) {
		$h = DateTime::createFromFormat('Y-m-d H:i', $v['hStart'])->format('G');
		$times[$k]['price'] = $v['diff'] * (empty($cost["hr{$h}"]) ? 0 : $cost["hr{$h}"]) / 3600;
	}
	return $times;
}

print_r(hourDistCost($start, $end, $cost));