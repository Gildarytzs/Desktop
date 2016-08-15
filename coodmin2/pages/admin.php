<?php include "header.php";?>


<div id="bids" class="container-row text-center">
    <div class="row">
        
        <?php
        $bidsNotVerify= dataSelect("*","bids","verified",0,1);
        foreach ($bidsNotVerify as $bidNotVerify) {
        	echo '<div class="col-md-2 text-center">';
        	echo '<div class="panel panel-default ">';
            echo '<div class="panel-heading">';
            echo '<h2>'. $bidNotVerify['title'] .'</h2>';
            echo '</div>';
            echo '<div class="panel-body">';
            echo '<img class="img-responsive " src="'. $bidNotVerify['image'] .'" alt="'. $bidNotVerify['title'] .'">';
            echo '<p>'. html_entity_decode($bidNotVerify['descriptive']) .'</p>';
            echo '<a <button type="button" class="btn btn-default" href="verify_bid.php?id=' .$bidNotVerify['id'] .'"><span class="glyphicon glyphicon-ok"></span></button></a>';
            echo '<a <button type="button" class="btn btn-default" href="refuse_bid.php?id=' .$bidNotVerify['id'] .'"><span class="glyphicon glyphicon-remove"></span></button></a>';
            echo '</div><div class="panel-footer">';
            echo '</div></div></div>';
    }
                    
        ?>
    </div>
</div>
