<!DOCTYPE html>
<html>
<head>
    <title>Emergency SOS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-red-50">

<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow w-full max-w-lg">

        <h1 class="text-2xl font-bold text-red-600 mb-6">
            🚨 Emergency SOS Request
        </h1>

        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="/client/sos">
            <?php echo csrf_field(); ?>

            <div class="mb-4">
                <label class="block font-semibold">Emergency Type</label>
                <input type="text" name="emergency_type" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Description</label>
                <textarea name="description" class="w-full border p-2 rounded" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Location</label>
                <input type="text" name="location" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold">Phone</label>
                <input type="text" name="phone" class="w-full border p-2 rounded" required>
            </div>

            <button class="w-full bg-red-600 text-white py-2 rounded font-bold">
                Submit SOS
            </button>
        </form>

    </div>
</div>

</body>
</html><?php /**PATH C:\Users\user\Desktop\lexaid\resources\views/sos_create.blade.php ENDPATH**/ ?>