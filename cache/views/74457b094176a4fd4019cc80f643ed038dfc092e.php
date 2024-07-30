<?php $__env->startSection('content'); ?>
<div class="wrap max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4"><?php echo e(__('Movies List', 'nhrrob-movies')); ?></h1>
    <a href="<?php echo e(admin_url('admin.php?page=nhrrob-movies&action=create')); ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block"><?php echo e(__('Add New Movie', 'nhrrob-movies')); ?></a>
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b"><?php echo e(__('Title', 'nhrrob-movies')); ?></th>
                <th class="py-2 px-4 border-b"><?php echo e(__('Description', 'nhrrob-movies')); ?></th>
                <th class="py-2 px-4 border-b"><?php echo e(__('Release Date', 'nhrrob-movies')); ?></th>
                <th class="py-2 px-4 border-b"><?php echo e(__('Actions', 'nhrrob-movies')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="py-2 px-4 border-b"><?php echo e($movie->title); ?></td>
                    <td class="py-2 px-4 border-b"><?php echo e($movie->description); ?></td>
                    <td class="py-2 px-4 border-b"><?php echo e($movie->release_date); ?></td>
                    <td class="py-2 px-4 border-b">
                        <a href="<?php echo e(admin_url('admin.php?page=nhrrob-movies&action=edit&id=' . $movie->id)); ?>" class="text-blue-500 hover:underline"><?php echo e(__('Edit', 'nhrrob-movies')); ?></a> |
                        <a href="<?php echo e(admin_url('admin-post.php?action=nhrrob_movies_delete&id=' . $movie->id)); ?>" class="text-red-500 hover:underline"><?php echo e(__('Delete', 'nhrrob-movies')); ?></a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/robinwpdeveloper/Sites/nhrrob-dev/wp-content/plugins/nhrrob-movies/app/Views/admin/movie/index.blade.php ENDPATH**/ ?>