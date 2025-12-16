<?php
/**
 * Team: DBIS Lab
 * Authors: Member 3
 * Date: 2025-12-09
 * Description: Hero Index View
 */

$this->title = '英雄人物';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hero-index">
    <!-- Content from war-memorial-frontend/templates/pages/heroes.php will be integrated here -->
    <?php echo $this->renderFile('@app/war-memorial-frontend/templates/pages/heroes.php'); ?>
</div>
