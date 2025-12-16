<?php
/**
 * Team: DBIS Lab
 * Authors: Member 2
 * Date: 2025-12-09
 * Description: Battle Index View
 */

$this->title = '重大战役';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="battle-index">
    <!-- Content from war-memorial-frontend/templates/pages/battles.php will be integrated here -->
    <?php echo $this->renderFile('@app/war-memorial-frontend/templates/pages/battles.php'); ?>
</div>
