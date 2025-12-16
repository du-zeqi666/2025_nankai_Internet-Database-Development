<?php
/**
 * Team: DBIS Lab
 * Authors: Member 4
 * Date: 2025-12-09
 * Description: Memorial Site Index View
 */

$this->title = '纪念地';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="memorial-site-index">
    <!-- Content from war-memorial-frontend/templates/pages/sites.php will be integrated here -->
    <?php echo $this->renderFile('@app/war-memorial-frontend/templates/pages/sites.php'); ?>
</div>
