<!DOCTYPE html>
<html>
<head>
    <title>Performance Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="min-h-screen p-10">
    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold">Performance Dashboard</h1>
                <p class="text-gray-600">Analytics and workload reporting</p>
            </div>

            <a href="/admin" class="bg-blue-900 text-white px-4 py-2 rounded">
                Back to Admin Dashboard
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Total Cases</h3>
                <p class="text-4xl font-bold"><?php echo e($totalCases); ?></p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Open Cases</h3>
                <p class="text-4xl font-bold text-blue-600"><?php echo e($openCases); ?></p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">In Progress</h3>
                <p class="text-4xl font-bold text-yellow-600"><?php echo e($inProgressCases); ?></p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Closed Cases</h3>
                <p class="text-4xl font-bold text-green-600"><?php echo e($closedCases); ?></p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Clients</h3>
                <p class="text-4xl font-bold"><?php echo e($totalClients); ?></p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h3 class="text-gray-500">Lawyers</h3>
                <p class="text-4xl font-bold"><?php echo e($totalLawyers); ?></p>
            </div>

            <div class="bg-red-100 p-6 rounded shadow">
                <h3 class="text-red-700">Total SOS</h3>
                <p class="text-4xl font-bold text-red-700"><?php echo e($totalSos); ?></p>
            </div>

            <div class="bg-yellow-100 p-6 rounded shadow">
                <h3 class="text-yellow-700">Pending SOS</h3>
                <p class="text-4xl font-bold text-yellow-700"><?php echo e($pendingSos); ?></p>
            </div>
        </div>

        <div class="bg-white p-8 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Lawyer Workload</h2>

            <?php if($lawyerWorkload->count() > 0): ?>
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-3">Lawyer Name</th>
                            <th class="border p-3">Assigned Cases</th>
                            <th class="border p-3">Workload Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $lawyerWorkload; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lawyer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="border p-3"><?php echo e($lawyer->name); ?></td>
                                <td class="border p-3 text-center"><?php echo e($lawyer->total_cases); ?></td>
                                <td class="border p-3 text-center">
                                    <?php if($lawyer->total_cases >= 5): ?>
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded">High Load</span>
                                    <?php elseif($lawyer->total_cases >= 2): ?>
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded">Medium Load</span>
                                    <?php else: ?>
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded">Low Load</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-gray-600">No lawyers found.</p>
            <?php endif; ?>
        </div>

    </div>
</div>

</body>
</html><?php /**PATH C:\Users\user\Desktop\lexaid\resources\views/performance_dashboard.blade.php ENDPATH**/ ?>