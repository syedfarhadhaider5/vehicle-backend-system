<?php
/**
 * @author Ali Assad <aassad@autocenter.com>
 * @var yii\web\View $this
 * @var string $content
 */
?>
<?php $this->beginContent('@backend/views/layouts/common.php'); ?>
    <div class="box">
        <div class="box-body">
            <?php echo $content ?>
        </div>
    </div>
<?php $this->endContent(); ?>
