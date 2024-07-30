<?php $__env->startSection('content'); ?>
<div class="wrap">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold"><?php echo e(__('Movies List', 'nhrrob-movies')); ?></h1>
        <a href="<?php echo e(admin_url('admin.php?page=nhrrob-movies-add')); ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            <?php echo e(__('Add Movie', 'nhrrob-movies')); ?>

        </a>
    </div>
    <table class="min-w-full bg-white shadow-md rounded-lg">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 border-b text-left"><?php echo e(__('Title', 'nhrrob-movies')); ?></th>
                <th class="py-2 px-4 border-b text-left"><?php echo e(__('Description', 'nhrrob-movies')); ?></th>
                <th class="py-2 px-4 border-b text-left"><?php echo e(__('Release Date', 'nhrrob-movies')); ?></th>
                <th class="py-2 px-4 border-b text-right"><?php echo e(__('Actions', 'nhrrob-movies')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b"><?php echo e($movie->title); ?></td>
                <td class="py-2 px-4 border-b"><?php echo e($movie->description); ?></td>
                <td class="py-2 px-4 border-b"><?php echo e($movie->release_date); ?></td>
                <td class="py-2 px-4 border-b text-right">
                    <a href="<?php echo e(admin_url('admin.php?page=nhrrob-movies-edit&id=' . $movie->id)); ?>" class="text-blue-600 hover:underline"><?php echo e(__('Edit', 'nhrrob-movies')); ?></a>
                    <a href="<?php echo e(admin_url('admin.php?page=nhrrob-movies-delete&id=' . $movie->id)); ?>" class="text-red-600 hover:underline ml-4"><?php echo e(__('Delete', 'nhrrob-movies')); ?></a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/robinwpdeveloper/Sites/nhrrob-dev/wp-content/plugins/nhrrob-movies/app/Views/admin/movies-list.blade.php ENDPATH**/ ?>