<?php $__env->startSection('content'); ?>
<div class="wrap">
    <h1><?php echo e(__('Edit Movie', 'nhrrob-movies')); ?></h1>
    <form method="post" action="<?php echo e(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="nhrrob_movies_save">
        <?php echo wp_nonce_field('nhrrob_movies_nonce_action', 'nhrrob_movies_nonce'); ?>

        <input type="hidden" name="movie_id" value="<?php echo e($movie->id); ?>">

        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php echo e(__('Title', 'nhrrob-movies')); ?></th>
                <td><input type="text" name="title" value="<?php echo e($movie->title); ?>" required></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php echo e(__('Description', 'nhrrob-movies')); ?></th>
                <td><textarea name="description"><?php echo e($movie->description); ?></textarea></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php echo e(__('Release Date', 'nhrrob-movies')); ?></th>
                <td><input type="date" name="release_date" value="<?php echo e($movie->release_date); ?>"></td>
            </tr>
        </table>
        <p><button type="submit" class="button button-primary"><?php echo e(__('Update Movie', 'nhrrob-movies')); ?></button></p>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/robinwpdeveloper/Sites/nhrrob-dev/wp-content/plugins/nhrrob-movies/app/Views/admin/movie-edit.blade.php ENDPATH**/ ?>