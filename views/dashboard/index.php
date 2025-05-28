<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestión de Productos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/dash.css">
</head>
<body>    
    <div class="dashboard-container">
        <?php include 'sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1>Panel de Control</h1>
                <p>Gestiona tu catálogo de productos y categorías de manera eficiente</p>
            </div>

            <!-- Statistics -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-number" id="totalProducts">0</div>
                    <div class="stat-label">Total Productos</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="stat-number" id="totalCategories">0</div>
                    <div class="stat-label">Categorías</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-number" id="avgPrice">$0</div>
                    <div class="stat-label">Precio Promedio</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-number" id="recentUpdates">0</div>
                    <div class="stat-label">Actualizaciones Recientes</div>
                </div>
            </div>

            <!-- Action Cards -->
            <div class="actions-grid">
                <div class="action-card">
                    <div class="action-icon">
                        <i class="fas fa-cube"></i>
                    </div>
                    <h3 class="action-title">Gestión de Productos</h3>
                    <p class="action-description">
                        Administra tu catálogo completo de productos. Crea, edita, elimina y organiza productos con imágenes, precios y descripciones detalladas.
                    </p>
                    <button class="action-btn" onclick="navigateToProducts()">
                        Gestionar Productos
                    </button>
                    <div class="world-map"></div>
                </div>

                <div class="action-card categories-card">
                    <div class="action-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <h3 class="action-title">Gestión de Categorías</h3>
                    <p class="action-description">
                        Organiza y estructura tu inventario con categorías personalizadas. Crea jerarquías y asocia productos para una mejor organización.
                    </p>
                    <button class="action-btn" onclick="navigateToCategories()">
                        Gestionar Categorías
                    </button>
                    <div class="world-map"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simulación de datos para las estadísticas
        function loadDashboardStats() {
            // Simular carga de datos desde base de datos
            const stats = {
                totalProducts: Math.floor(Math.random() * 500) + 100,
                totalCategories: Math.floor(Math.random() * 50) + 10,
                avgPrice: Math.floor(Math.random() * 1000) + 50,
                recentUpdates: Math.floor(Math.random() * 20) + 5
            };

            // Animar contadores
            animateCounter('totalProducts', stats.totalProducts);
            animateCounter('totalCategories', stats.totalCategories);
            animateCounter('recentUpdates', stats.recentUpdates);
            
            // Formato especial para precio
            setTimeout(() => {
                document.getElementById('avgPrice').textContent = `$${stats.avgPrice}`;
            }, 1500);
        }

        function animateCounter(elementId, finalValue) {
            const element = document.getElementById(elementId);
            let currentValue = 0;
            const increment = finalValue / 50;
            const timer = setInterval(() => {
                currentValue += increment;
                if (currentValue >= finalValue) {
                    element.textContent = Math.floor(finalValue);
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(currentValue);
                }
            }, 30);
        }

        // Navegación
        function navigateToProducts() {
            showNotification('Navegando a Gestión de Productos...', 'info');
            // Aquí iría la lógica para navegar a la página de productos
            setTimeout(() => {
                window.location.href = 'productos.php';
            }, 1000);
        }

        function navigateToCategories() {
            showNotification('Navegando a Gestión de Categorías...', 'info');
            // Aquí iría la lógica para navegar a la página de categorías
            setTimeout(() => {
                window.location.href = 'categorias.php';
            }, 1000);
        }

        function handleLogout() {
            if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
                showNotification('Cerrando sesión...', 'warning');
                setTimeout(() => {
                    window.location.href = 'login.php';
                }, 1500);
            }
        }

        // Sistema de notificaciones
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type === 'info' ? 'primary' : type === 'warning' ? 'warning' : 'success'} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(notification);

            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 4000);
        }

        // Manejo de navegación activa
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Efectos de hover para las cards
        document.querySelectorAll('.action-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Cargar estadísticas al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            loadDashboardStats();
            showNotification('¡Bienvenido al Dashboard de Gestión!', 'success');
        });

        // Actualizar estadísticas cada 30 segundos
        setInterval(loadDashboardStats, 30000);
    </script>
</body>
</html>