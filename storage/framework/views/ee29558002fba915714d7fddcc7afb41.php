<h2>All Cases</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Status</th>
        <th>Priority</th>
    </tr>

    <?php $__currentLoopData = $cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <td><?php echo e($case->id); ?></td>
        <td><?php echo e($case->title); ?></td>
        <td><?php echo e($case->status); ?></td>
        <td><?php echo e($case->priority); ?></td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table><?php /**PATH C:\Users\user\Desktop\lexaid\resources\views/cases.blade.php ENDPATH**/ ?>