<!DOCTYPE html>
<html>
<head>
    <title>Admin SOS Requests</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="min-h-screen p-10">
    <div class="max-w-6xl mx-auto bg-white p-8 rounded shadow">

        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-red-600">Emergency SOS Requests</h1>
                <p class="text-gray-600">Admin Panel - Fast-track urgent legal matters</p>
            </div>

            <a href="/admin" class="bg-blue-900 text-white px-4 py-2 rounded">
                Back to Admin Dashboard
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if($sosRequests->count() > 0): ?>
            <table class="w-full border">
                <thead>
                    <tr class="bg-red-100">
                        <th class="border p-2">ID</th>
                        <th class="border p-2">Client</th>
                        <th class="border p-2">Email</th>
                        <th class="border p-2">Type</th>
                        <th class="border p-2">Description</th>
                        <th class="border p-2">Location</th>
                        <th class="border p-2">Phone</th>
                        <th class="border p-2">Status</th>
                        <th class="border p-2">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $sosRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="border p-2"><?php echo e($sos->id); ?></td>
                            <td class="border p-2"><?php echo e($sos->client_name); ?></td>
                            <td class="border p-2"><?php echo e($sos->client_email); ?></td>
                            <td class="border p-2"><?php echo e($sos->emergency_type); ?></td>
                            <td class="border p-2"><?php echo e($sos->description); ?></td>
                            <td class="border p-2"><?php echo e($sos->location); ?></td>
                            <td class="border p-2"><?php echo e($sos->phone); ?></td>
                            <td class="border p-2 font-bold"><?php echo e(ucfirst($sos->status)); ?></td>
                            <td class="border p-2">
                                <form method="POST" action="/admin/sos/update/<?php echo e($sos->id); ?>">
                                    <?php echo csrf_field(); ?>
                                    <select name="status" class="border p-1 rounded">
                                        <option value="pending" <?php echo e($sos->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                        <option value="reviewing" <?php echo e($sos->status == 'reviewing' ? 'selected' : ''); ?>>Reviewing</option>
                                        <option value="resolved" <?php echo e($sos->status == 'resolved' ? 'selected' : ''); ?>>Resolved</option>
                                    </select>

                                    <button class="bg-green-600 text-white px-3 py-1 rounded mt-2">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded">
                No SOS requests found.
            </div>
        <?php endif; ?>

    </div>
</div>

</body>
</html><?php /**PATH C:\Users\user\Desktop\lexaid\resources\views/admin_sos.blade.php ENDPATH**/ ?>