<?php echo $__env->make('charts::_partials/container.div-titled', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<script type="text/javascript">
    $(function (){
        Morris.Donut({
            element: "<?php echo e($model->id); ?>",
            resize: true,
            data: [
                <?php for($i = 0; $i < count($model->values); $i++): ?>
                    {
                        label: "<?php echo $model->labels[$i]; ?>",
                        value: "<?php echo e($model->values[$i]); ?>"
                    },
                <?php endfor; ?>
            ],
            <?php if($model->colors): ?>
                colors: [
                    <?php $__currentLoopData = $model->colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        "<?php echo e($c); ?>",
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                ]
            <?php endif; ?>
        })
    });
</script>
