<?php $__env->startSection('content'); ?>
    <h1><?php echo e($title); ?></h1>
    <p>72 phep than thong nhu Ton Ngo Khong</p>
    <?php if(count($services)>0): ?>
    <ul class="list-group">  
        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="list-group-item"><?php echo e($service); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </ul>
        
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\code\lrvappl\resources\views/pages/services.blade.php ENDPATH**/ ?>