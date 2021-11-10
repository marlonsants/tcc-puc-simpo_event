<?php ($min = count($model->values) >= 2 ? $model->values[1] : 0); ?>
<?php ($max = count($model->values) >= 3 ? $model->values[2] : 100); ?>

<?php echo $__env->make('charts::_partials.container.title', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div id="<?php echo e($model->id); ?>" style="position: relative;<?php echo $__env->make('charts::_partials.dimension.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>"></div>

<script type="text/javascript">
    $(function() {
        var <?php echo e($model->id); ?> = new ProgressBar.Line('#<?php echo e($model->id); ?>', {
            <?php if($model->colors and count($model->colors)): ?>
                color: "<?php echo e($model->colors[0]); ?>",
            <?php else: ?>
                color: '#ffc107',
            <?php endif; ?>
            strokeWidth: 4,
            svgStyle: {width: '100%', height: '100%'},
            easing: 'easeInOut',
            duration: 1000,
            trailColor: '#eee',
            trailWidth: 4,
        })

        <?php echo e($model->id); ?>.animate(<?php echo e(($model->values[0] - $min) / ($max - $min)); ?>)
    });
</script>
