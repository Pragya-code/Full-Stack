

<?php $__env->startSection('title', 'All Students'); ?>

<?php $__env->startSection('content'); ?>
    <a href="index.php?action=create" class="btn btn-success">Add New Student</a>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($students) > 0): ?>
                <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($student['id']); ?></td>
                        <td><?php echo e($student['name']); ?></td>
                        <td><?php echo e($student['email']); ?></td>
                        <td><?php echo e($student['course']); ?></td>
                        <td>
                            <a href="index.php?action=edit&id=<?php echo e($student['id']); ?>" class="btn">Edit</a>
                            <a href="index.php?action=delete&id=<?php echo e($student['id']); ?>" 
                               class="btn btn-danger" 
                               onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No students found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\fullstack\workshop8\app\views/students/index.blade.php ENDPATH**/ ?>