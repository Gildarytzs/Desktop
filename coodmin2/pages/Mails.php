<?php 
require 'mail.php';
?>

<div id="bids" class="container-fluid text-center">
    <div class="row">
        <h2 class="mb text-center">Boite de reception</h2>
        <div class="col-md-2"></div>
        <?php
        $mails = dataSelectAll("*", "mail");
        foreach ($mails as $m) {
            $mail = dataSelect("*", "mails", "id", $m['id'], 0);
            while ( $row = $mail -> fetch()	 ) 
           		{
	            	
	            	if ($row['readed']==0) {
	            		echo '<div class="col-md-2">';
	            		echo '<div class="panel panel-default">';
	            		echo '<div class="panel-heading background-orange">';
	            		echo "<a style='color : black;'  href='mymailrec.php?id=".$row['id']."'> 
	            		<div class='panel-body'>".$row['receveur']."</div>
	            		<div class='panel-body'>".$row['objet']."</div>
	            		<div class='panel-body'>".$row['time']."</div></a>";
	            		echo '</div></div>';
	            	}else{
	            		echo '<div class="col-md-2">';
	            		echo '<div class="panel panel-default">';
	            		echo '<div class="panel-heading background-orange">';
	                	echo "<a style='color : black;'  href='mymailrec.php?id=".$row['id']."'> <div class='panel-body'>".$row['receveur']."</div>
	                	<div class='panel-body'>".$row['objet']."</div>
	                	<div class='panel-body'>".$row['time']."</div></a>";
	                	echo "</div></div>";
	                }
	                echo "</div><br>";
	            }
        ?>
        <div class="col-md-2"></div>
    </div>
</div>
<?php include "footer.php";?>