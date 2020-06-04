

<?php $__env->startSection('content'); ?>
    <h1><?php echo e($title); ?></h1>
<p><?php echo e($posts); ?></p>

</table>    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\code\lrvappl\resources\views/pages/index.blade.php ENDPATH**/ ?>