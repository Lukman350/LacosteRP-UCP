<?php
require "SampQueryAPI.php";
$query = new SampQueryAPI('35.247.149.106', '7777');

	$aInformation = $query->getInfo();
	$aServerRules = $query->getRules();
	
	?>
	<h4><b>Online Players: <?php echo $aInformation['players'] ?></b></h4><hr />
	<?php
	
	$aPlayers = $query->getDetailedPlayers();
	
	if(is_array($aPlayers)) {
		?>
		<div class="scrollable-table"><table class="table table-def table-condensed table-striped table-bordered table-hover"><thead><tr><th><b>ID</b></th><th><b>Character</b></th><th><b>Level</b></th></tr></thead><tbody><?php if ($query->isOnline()) { foreach($aPlayers as $sValue) { ?><tr><td><?= $sValue['playerid'] ?></td><td><?= $sValue['nickname'] ?></td><td><?= $sValue['score'] ?></td></tr><?php } } else echo "<tr><td colspan='3'><b>Server didn't respond!</b></td></tr>"; ?></tbody><?php  echo '</table></div>';
	}
?>