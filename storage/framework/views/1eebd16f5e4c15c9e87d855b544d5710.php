<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand-link text-center">
        <span class="brand-text font-weight-light">LARAVEL SHOP</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column">

                <li class="nav-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>"
                       class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('admin.categories.index')); ?>"
                       class="nav-link <?php echo e(request()->routeIs('admin.categories.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('admin.sub-categories.index')); ?>"
                       class="nav-link <?php echo e(request()->routeIs('admin.sub-categories.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Sub Categories</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('admin.brands.index')); ?>"
                       class="nav-link <?php echo e(request()->routeIs('admin.brands.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Brands</p>
                    </a>
                </li>

                <li class="nav-header">ACCOUNT</li>

                <li class="nav-item">
                    <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                                class="nav-link text-danger"
                                style="background:none;border:none;width:100%;text-align:left;">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </div>

</aside><?php /**PATH C:\Users\Admin\Desktop\code\laravel_online_shop\resources\views\admin\layouts\sidebar.blade.php ENDPATH**/ ?>