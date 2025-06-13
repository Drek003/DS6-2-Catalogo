<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo BASE_URL; ?>">
            <i class="fas fa-store"></i> Catálogo
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>views/categories/index.php">
                        <i class="fas fa-tags"></i> Categorías
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo BASE_URL; ?>views/products/index.php">
                        <i class="fas fa-box"></i> Productos
                    </a>
                </li>
                
                <?php if (isAdmin()): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-cog"></i> Administración
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>views/categories/create.php">
                            <i class="fas fa-plus"></i> Nueva Categoría
                        </a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>views/products/create.php">
                            <i class="fas fa-plus"></i> Nuevo Producto
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>views/categories/index.php">
                            <i class="fas fa-edit"></i> Gestionar Categorías
                        </a></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>views/products/index.php">
                            <i class="fas fa-edit"></i> Gestionar Productos
                        </a></li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
            
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i> <?php echo $_SESSION['username']; ?>
                        <span class="badge bg-<?php echo isAdmin() ? 'danger' : 'info'; ?> ms-1">
                            <?php echo ucfirst($_SESSION['role']); ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><h6 class="dropdown-header">
                            <i class="fas fa-info-circle"></i> Información de Usuario
                        </h6></li>
                        <li><span class="dropdown-item-text">
                            <strong>Usuario:</strong> <?php echo $_SESSION['username']; ?><br>
                            <strong>Email:</strong> <?php echo $_SESSION['email']; ?><br>
                            <strong>Rol:</strong> <?php echo ucfirst($_SESSION['role']); ?>
                        </span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>views/auth/logout.php">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>