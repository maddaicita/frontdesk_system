<?php
/**
 * @version		$Id: coolfeed.php 100 2012-04-14 17:42:51Z trung3388@gmail.com $
 * @copyright	JoomAvatar.com
 * @author		Nguyen Quang Trung
 * @link		http://joomavatar.com
 * @license		License GNU General Public License version 2 or later
 * @package		Avatar Dream Framework Template
 * @facebook 	http://www.facebook.com/pages/JoomAvatar/120705031368683
 * @twitter	    https://twitter.com/#!/JoomAvatar
 * @support 	http://joomavatar.com/forum/
 */

// No direct access
defined('_JEXEC') or die;
$baseurl = JURI::base();
?>
<ul class="latestnews-date-title">
<?php foreach ($list as $item) :  ?>
	<?php 
		$time = strtotime($item->created);
		$day = date("d", $time);
		$month = date("M", $time);
		
	?>
	<li>
		<div class="date">
			<span class="day"><?php echo $day; ?></span>
			<span class="month"><?php echo $month; ?></span>
		</div>
		<a class="title" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
		<span class="author"><?php echo $item->author; ?></span>
	</li>
<?php endforeach; ?>
</ul>
