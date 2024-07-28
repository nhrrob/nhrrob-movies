<?php $__env->startSection('content'); ?>
<div class="wrap">
    <h1><?php echo e(__('NHRRob Movies Settings', 'nhrrob-movies')); ?></h1>
    <form method="post" action="options.php">
        <?php settings_fields('nhrrob_movies_options_group'); ?>
        <?php do_settings_sections('nhrrob-movies'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php echo e(__('Option Name', 'nhrrob-movies')); ?></th>
                <td><input type="text" name="nhrrob_movies_option_name" value="<?php echo e(esc_attr(get_option('nhrrob_movies_option_name'))); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/robinwpdeveloper/Sites/nhrrob-dev/wp-content/plugins/nhrrob-movies/app/Views/admin/settings.blade.php ENDPATH**/ ?>