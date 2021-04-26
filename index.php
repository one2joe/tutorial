<?php
$start = '2021-04-17 23:50';
$end = '2021-04-18 11:30';
// $start = '2021-04-17 23:00';
// $end = '2021-04-18 02:00';

function hourDist ($start, $end) {
	$hStartRange = floor(strtotime($start) / 3600);
	$hEndRange = floor((strtotime($end) - 1) / 3600);
	$result = [];
	for ($v = $hStartRange; $v <= $hEndRange; $v++) {
		if ($v * 3600 < strtotime($start))
			$hStart = strtotime($start);
		else
			$hStart = $v * 3600;
		if (strtotime($end) < ($v + 1) * 3600)
			$hEnd = strtotime($end);
		else
			$hEnd = ($v + 1) * 3600;
		$result[] = [
			'hStart' => DateTime::createFromFormat('U', $hStart)->format('Y-m-d H:i'),
			'hEnd' => DateTime::createFromFormat('U', $hEnd)->format('Y-m-d H:i'),
			'diff' => $hEnd - $hStart
		];
	}
	return $result;
}

$cost = [
	'site' => "ANC1603",
	'subimpact_tech_name' => "36850",
	'subimpact_data_name' => "CS",
	'subimpact_event_name' => "WEEKEND",
	'hr0' => "7",
	'hr1' => "3",
	'hr2' => "2.5",
	'hr3' => "3.5",
	'hr4' => "6",
	'hr5' => "9",
	'hr6' => "43",
	'hr7' => "56",
	'hr17' => "90.5",
	'hr18' => "70",
	'hr19' => "38.5",
	'hr20' => "6.5",
	'hr21' => "19",
	'hr22' => "4.5",
	'hr23' => "6.5",
];

function hourDistCost ($start, $end, $cost) {
	$result = hourDist($start, $end);
	foreach ($result as $key => $value) {
		$h = DateTime::createFromFormat('Y-m-d H:i', $value['hStart'])->format('G');
		$result[$key]['price'] = $value['diff'] / 3600 * (empty($cost["hr{$h}"]) ? 0 : $cost["hr{$h}"]);
	}
	return $result;
}

// $result = hourDist($start, $end);
$result = hourDistCost($start, $end, $cost);

// $start = DateTime::createFromFormat('U', $start * 3600)->format('Y-m-d H:i');
// $end = DateTime::createFromFormat('U', $end * 3600)->format('Y-m-d H:i');
exit;