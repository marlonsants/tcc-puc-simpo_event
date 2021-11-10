<?php echo $__env->make('charts::_partials/container.div-titled', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
    $(function () {
        Morris.Bar({
            element: "<?php echo e($model->id); ?>",
            resize: true,
            data: [
                <?php for($i = 0; $i < count($model->values); $i++): ?>
                    {
                        x: "<?php echo $model->labels[$i]; ?>",
                        y: <?php echo e($model->values[$i]); ?>

                    },
                <?php endfor; ?>
            ],
            xkey: 'x',
            ykeys: ['y'],
            labels: ["<?php echo $model->element_label; ?>"],
            hideHover: 'auto',
            <?php if($model->colors): ?>
                barColors: function (row, series, type) {
                    <?php for($i = 0; $i < count($model->colors); $i++): ?>
                        <?php if($i == 0): ?>
                            if(row.label == "<?php echo e($model->labels[$i]); ?>") return "<?php echo e($model->colors[$i]); ?>"
                        <?php else: ?>
                            else if(row.label == "<?php echo e($model->labels[$i]); ?>") return "<?php echo e($model->colors[$i]); ?>"
                        <?php endif; ?>
                    <?php endfor; ?>
                }
            <?php endif; ?>
        })
    });
</script>
