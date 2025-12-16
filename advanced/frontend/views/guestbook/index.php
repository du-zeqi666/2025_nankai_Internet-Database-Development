<?php
/**
 * Team: DBIS Lab
 * Authors: Member 4
 * Date: 2025-12-09
 * Description: Guestbook Index View
 */

$this->title = '留言板';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guestbook-index">
    <!-- Content from war-memorial-frontend/templates/pages/guestbook.php will be integrated here -->
    <?php echo $this->renderFile('@app/war-memorial-frontend/templates/pages/guestbook.php'); ?>
</div>
