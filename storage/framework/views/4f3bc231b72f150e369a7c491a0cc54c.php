<h2>Create Case</h2>

<form method="POST" action="/case/store">
    <?php echo csrf_field(); ?>

    <input type="text" name="title" placeholder="Case Title"><br><br>

    <textarea name="description" placeholder="Description"></textarea><br><br>

    <input type="text" name="case_type" placeholder="Case Type"><br><br>

    <input type="text" name="location" placeholder="Location"><br><br>

    <input type="date" name="deadline"><br><br>

    <button type="submit">Submit Case</button>
</form>
<h2>All Cases</h2>

<table border="1" cellpadding="10">
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
</table><?php /**PATH C:\Users\user\Desktop\lexaid\resources\views/create_case.blade.php ENDPATH**/ ?>