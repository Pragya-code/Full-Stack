

<?php $__env->startSection('title', 'Add New Student'); ?>

<?php $__env->startSection('content'); ?>
    
    <form action="index.php?action=store" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="course">Course:</label>
            <input type="text" id="course" name="course" required>
        </div>
        
        <button type="submit" class="btn btn-success">Add Student</button>
        <a href="index.php?action=index" class="btn">Cancel</a>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fullstack\workshop8\app\views/students/create.blade.php ENDPATH**/ ?>