<?php
$start = '2021-04-17 23:50';
$end = '2021-04-18 2:45';

function hourDist ($start, $end) {
	$times = [];
	for ($m = strtotime($start) / 60; $m < strtotime($end) / 60 + 60; $m+=60) {
		$hStart = $m == strtotime($start) ? $m : ($m - ($m % 60));
		$hEnd = $m + (60 - $m % 60);
		if ($hStart < strtotime($end) / 60) {
			$times[] = [
				'hStart' => DateTime::createFromFormat('U', $hStart * 60)->format('Y-m-d H:i'),
				'hEnd' => DateTime::createFromFormat('U', $hEnd * 60)->format('Y-m-d H:i'),
				'diff' => $hEnd - $hStart,
			];
		}
	}
	return  $times;
}

print_r(hourDist($start, $end));