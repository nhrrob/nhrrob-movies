<?php $__env->startSection('content'); ?>
<div class="wrap max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4"><?php echo e(__('Movies', 'nhrrob-movies')); ?></h1>
    <a href="<?php echo e(admin_url('admin.php?page=nhrrob-movies&action=create')); ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"><?php echo e(__('Add New Movie', 'nhrrob-movies')); ?></a>
    
    <table class="w-full mt-4 border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 p-2"><?php echo e(__('ID', 'nhrrob-movies')); ?></th>
                <th class="border border-gray-300 p-2"><?php echo e(__('Title', 'nhrrob-movies')); ?></th>
                <th class="border border-gray-300 p-2"><?php echo e(__('Actions', 'nhrrob-movies')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="border border-gray-300 p-2"><?php echo e($movie->id); ?></td>
                <td class="border border-gray-300 p-2"><?php echo e($movie->title); ?></td>
                <td class="border border-gray-300 p-2">
                    <a href="<?php echo e(admin_url('admin.php?page=nhrrob-movies&action=edit&id=' . $movie->id)); ?>" class="text-blue-500"><?php echo e(__('Edit', 'nhrrob-movies')); ?></a>
                    <a href="<?php echo e(admin_url('admin-post.php?action=nhrrob_movies_delete&id=' . $movie->id . '&_wpnonce=' . wp_create_nonce('nhrrob_movies_delete_nonce'))); ?>" class="text-red-500 ml-2"><?php echo e(__('Delete', 'nhrrob-movies')); ?></a>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/robinwpdeveloper/Sites/nhrrob-dev/wp-content/plugins/nhrrob-movies/resources/views/admin/movie/index.blade.php ENDPATH**/ ?>