<?php
/**
 * Team: DBIS Lab
 * Authors: Member 2
 * Date: 2025-12-09
 * Description: Timeline Index View
 */

$this->title = '时间轴';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timeline-index">
    <!-- Content from war-memorial-frontend/templates/pages/timeline.php will be integrated here -->
    <?php echo $this->renderFile('@app/war-memorial-frontend/templates/pages/timeline.php'); ?>
</div>
