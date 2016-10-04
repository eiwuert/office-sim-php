<form action="process.php" method="POST">
<div><label>Title</label><br/><input type="text" value="" name="title" /></div>
<div><label>Teaser</label><br/><textarea name="teaser"></textarea></div>
<input name="host" type="hidden" value="<?php print $_GET['host']; ?>" />
<div><input type="submit" value="Submit" name="Submit"></div>
</form>