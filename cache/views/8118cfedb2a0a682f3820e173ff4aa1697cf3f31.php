<?php $__env->startSection('content'); ?>
<div class="wrap">
    <h1><?php echo e(__('Movies', 'nhrrob-movies')); ?></h1>
    <table class="widefat fixed" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo e(__('ID', 'nhrrob-movies')); ?></th>
                <th><?php echo e(__('Title', 'nhrrob-movies')); ?></th>
                <th><?php echo e(__('Release Date', 'nhrrob-movies')); ?></th>
                <th><?php echo e(__('Actions', 'nhrrob-movies')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($movie->id); ?></td>
                    <td><?php echo e($movie->title); ?></td>
                    <td><?php echo e($movie->release_date); ?></td>
                    <td>
                        <a href="<?php echo e(admin_url('admin.php?page=nhrrob-movies-edit&id=' . $movie->id)); ?>"><?php echo e(__('Edit', 'nhrrob-movies')); ?></a>
                        |
                        <a href="<?php echo e(admin_url('admin-post.php?action=nhrrob_movies_delete&id=' . $movie->id . '&nhrrob_movies_nonce=' . wp_create_nonce('nhrrob_movies_delete_nonce'))); ?>"
                           onclick="return confirm('Are you sure you want to delete this movie?');">
                           <?php echo e(__('Delete', 'nhrrob-movies')); ?>

                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/robinwpdeveloper/Sites/nhrrob-dev/wp-content/plugins/nhrrob-movies/app/Views/admin/movies-list.blade.php ENDPATH**/ ?>