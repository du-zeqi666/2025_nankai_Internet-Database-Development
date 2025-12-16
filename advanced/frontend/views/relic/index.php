<?php
/**
 * Team: DBIS Lab
 * Authors: Member 3
 * Date: 2025-12-09
 * Description: Relic Index View
 */

$this->title = '文物陈列';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relic-index">
    <!-- Content from war-memorial-frontend/templates/pages/relics.php will be integrated here -->
    <?php echo $this->renderFile('@app/war-memorial-frontend/templates/pages/relics.php'); ?>
</div>
