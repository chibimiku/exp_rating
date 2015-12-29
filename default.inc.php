<?php 

//default. html

if(!defined('IN_RATING')){
	exit('Access Denied');
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<script src="jquery-1.11.3.min.js"></script>
<link rel="stylesheet" href="themes/css-stars.css">
</head>
<body>
<table><tbody><tr><td>
<form action="http://m.tsdm.net/exp_rating/index.php?action=add" method="post">
<div class="br-wrapper br-theme-fontawesome-stars">
	<select id="example" name="score">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
	</select>
</div>
<input type="hidden" name="id" value="<?php echo toinv($_GET['id']);?>" />
<input type="submit" value="submit" />
</form>
</td><td>
<p><?php echo "avg: $avg Ratenum: $ratenum";?></p></td></tr></tbody></table>
<script src="jquery.barrating.min.js"></script>
<script type="text/javascript">
   $(function() {
      $('#example').barrating({
        theme: 'css-stars',
		initialRating: <?php echo $mc;?>,
      });
   });
</script>
</body>
</html>