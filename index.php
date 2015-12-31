<?php 

define('IN_RATING', true);

require('meekrodb.2.3.class.php');
require('./conf/conf.inc.php');
require('./lang_zh.inc.php');

switch($_GET['action']){
	
	case 'add':
		$rs = addscore(toinv($_POST['id']), toinv($_POST['score']));
		if($rs){
			rtb($_POST['id']);
			exit('addscore_succ');
		}
	default:
		if(!isset($_GET['id'])){
			exit('id_not_set');
		}
		$id = toinv($_GET['id']);
		$info = DB::queryFirstRow('SELECT * FROM rating WHERE itemid='.$id);
		$ratenum = is_array($info) ? $info['ratenum'] : 0;
		$avg = intval($info['totalrate'])/max(1,intval($info['ratenum']));
		$avg = substr($avg, 0, 3);
		$myscore = DB::queryFirstRow('SELECT * FROM rating_log WHERE itemid='.$id.' AND ip=\''.getip().'\' ORDER BY timestamp DESC');
		$mc = $myscore ? $myscore['score']: 0 ;
		include 'default.inc.php';
}

function addscore($id, $score){
	if($score <= 0 || $score >5){
		exit('score_illegal');
	}
	$info = DB::queryFirstRow('SELECT * FROM rating WHERE itemid='.$id);
	if(!$info){
		//exit("$id info_not_found");
		DB::insert('rating',array('itemid'=>$id));
	}
	
	$myscore = DB::queryFirstRow('SELECT * FROM rating_log WHERE itemid='.$id.' AND ip=\''.getip().'\' ORDER BY timestamp DESC');
	if(!$myscore){
		$newscore = $info['totalrate']+$score;
		DB::update('rating', array('totalrate' => $newscore, 'ratenum' => $info['ratenum']+1),"itemid=$id");
		DB::insert('rating_log', array(
			'ip' => getip(),
			'itemid' => $id,
			'score' => $score,
			'timestamp' => time(),
			'opt' => 1,
		));
	}else{
		//update
		$newscore = $info['totalrate']+$score-$myscore['score'];
		DB::update('rating', array('totalrate' => $newscore, 'ratenum' => $info['ratenum']),"itemid=$id");
		DB::insert('rating_log', array(
			'ip' => getip(),
			'itemid' => $id,
			'score' => $score,
			'timestamp' => time(),
			'opt' => 0,
		));
	}
	
	return true;
}

function toinv($input){
	return intval($input);
}

function getip(){
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function rtb($id){
	echo '<script>window.location.href = "http://m.tsdm.net/exp_rating/index.php?id='.$id.'";</script>';
}

?>