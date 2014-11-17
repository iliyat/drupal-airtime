<?php
/**
 * Available variables:
 * - $current_track
 * - $current_show
 * - $station_link
 * -
 */
?>
<div id="airtime-block-now-playing">
	Now playing:<br> <b><?php print $current_track; ?></b>
</div>
<div id="airtime-block-now-playing">
	in show:<br> <b><?php print $current_show; ?></b>
</div>
<div id="airtime-block-station">
	<?php print $station_link; ?>
</div>
<hr>
This is an example block. Information is result of "live-info" api method.
