<?php 

function lang($key){
	
	$data = array(
		'avg_tip' => '平均分',
		'ratenum_tip' => '评分人数',
	);
	
	if(isset($data[$key])){
		return $data[$key];
	}else{
		return '!'.$key.'!';
	}
	

}

?>