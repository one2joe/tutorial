<?php
function toSQLDate ($date) {
	$result = NULL;
	if (($result = \DateTime::createFromFormat('M d, Y', $date)) === FALSE) {
		$find_replace = ['มกราคม' => 'Jan','กุมภาพันธ์' => 'Feb','มีนาคม' => 'Mar','เมษายน' => 'Apr','พฤษภาคม' => 'May','มิถุนายน' => 'Jun','กรกฎาคม' => 'Jul','สิงหาคม' => 'Aug','กันยายน' => 'Sep','ตุลาคม' => 'Oct','พฤศจิกายน' => 'Nov','ธันวาคม' => 'Dec','ม.ค.' => 'Jan','ก.พ.' => 'Feb','มี.ค.' => 'Mar','เม.ย.' => 'Apr','พ.ค.' => 'May','มิ.ย.' => 'Jun','ก.ค.' => 'Jul','ส.ค.' => 'Aug','ก.ย.' => 'Sep','ต.ค.' => 'Oct','พ.ย.' => 'Nov','ธ.ค.' => 'Dec'];
		$date = str_replace(array_keys($find_replace), array_values($find_replace), $date);
		preg_match('/\d{4}/', $date, $matches);
		if (!empty($matches[0]) AND $matches[0] > 2500) {
			$date = str_replace($matches[0], $matches[0] - 543, $date);
		}
		if (($result = \DateTime::createFromFormat('d M Y', $date)) === FALSE) {

		}
	}
	return $result->format('Y-m-d H:i:s');
}

$result = toSQLDate('May 02, 2021');
// $result = toSQLDate('1 เม.ย. 2021');

exit;