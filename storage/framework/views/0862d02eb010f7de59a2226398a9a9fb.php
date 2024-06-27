
:root {
<?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    --colors-primary-<?php echo e($key); ?>: <?php echo e($value); ?>;
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
}<?php /**PATH E:\new\inventory\storage\framework\views/7c5324e2cef4139f2a7a40f161e4c877.blade.php ENDPATH**/ ?>