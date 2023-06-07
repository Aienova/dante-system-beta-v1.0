
<form id="sender" data-action="<?php echo $feature; ?>" method="POST" action="">

<div id="searchbar" >
<input type="text" name="searchname" value="" placeholder="Rechercher par <?php if($feature=="formation" || $feature=="permission"){ echo 'n° Dossier';}else{ echo 'Nom';} ?> " />
<input type="submit" value="rechercher" />
</div>
</form>