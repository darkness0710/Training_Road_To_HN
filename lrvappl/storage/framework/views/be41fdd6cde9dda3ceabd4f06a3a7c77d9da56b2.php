<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
        <title>Lrvappl</title>

    </head>
    <body>
        <?php echo $__env->make('inc.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="container">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </body>
</html>
<?php /**PATH E:\xampp\htdocs\code\lrvappl\resources\views/layouts/app.blade.php ENDPATH**/ ?>