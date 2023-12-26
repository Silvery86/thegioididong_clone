<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:08 PM
 **/

use app\lib\App;

/**
 * @var App $app
 */
?>
<div class="footer">
	<div class="copyright">
		<p>Copyright © Developed by
			<a href="<?= $app->params['home_url'] ?>" target="_blank"><?= $app->params['name'] ?></a> <?= date('Y')?></p>
	</div>
</div>
</div>
</div>
</body>
</html>
