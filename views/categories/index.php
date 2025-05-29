<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/catg.css">
    
    
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <?php include '../../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="header-left">
                    <h1>Gestión de Categorías</h1>
                    <p>Organiza tu inventario con categorías personalizadas</p>
                </div>
                <div class="header-actions">
                    <div class="search-bar">
                        <input type="text" class="search-input" placeholder="Buscar categorías..." id="searchInput">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                    <button class="btn btn-primary-custom" data-bs-toggle="modal" data-bs-target="#categoryModal" onclick="openAddModal()">
                        <i class="fas fa-plus"></i> Nueva Categoría
                    </button>
                </div>
            </div>

            <!-- Categories Grid -->
            <div class="categories-grid" id="categoriesGrid">
                <!-- Las categorías se cargarán dinámicamente aquí -->
            </div>

            <!-- Empty State -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <i class="fas fa-tags"></i>
                <h3>No hay categorías</h3>
                <p>Comienza creando tu primera categoría para organizar tus productos</p>
                <button class="btn btn-primary-custom mt-3" data-bs-toggle="modal" data-bs-target="#categoryModal" onclick="openAddModal()">
                    <i class="fas fa-plus"></i> Crear Primera Categoría
                </button>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar/Editar Categoría -->
    <div class="modal fade modal-custom" id="categoryModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Nueva Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="categoryForm">
                        <input type="hidden" id="categoryId">
                        
                        <div class="form-group">
                            <label class="form-label" for="categoryName">
                                <i class="fas fa-tag"></i> Nombre de la Categoría
                            </label>
                            <input type="text" class="form-control-custom" id="categoryName" placeholder="Ej: Electrónicos, Ropa, Hogar..." required>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="categoryDescription">
                                <i class="fas fa-align-left"></i> Descripción
                            </label>
                            <textarea class="form-control-custom" id="categoryDescription" rows="4" placeholder="Describe esta categoría y qué productos incluye..."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-image"></i> Imagen de la Categoría
                            </label>
                            <input type="file" id="categoryImage" accept="image/*" style="display: none;">
                            <div class="image-preview" onclick="document.getElementById('categoryImage').click();" id="imagePreview">
                                <div class="upload-placeholder">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <div>Haz clic para subir una imagen</div>
                                    <small>JPG, PNG o GIF (máx. 5MB)</small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer p-4">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary-custom" onclick="saveCategory()">
                        <i class="fas fa-save"></i> Guardar Categoría
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Datos simulados de categorías
        let categories = [
            {
                id: 1,
                name: 'Electrónicos',
                description: 'Dispositivos electrónicos, smartphones, laptops y accesorios tecnológicos',
                image: 'https://via.placeholder.com/320x200/4A5D5A/FFFFFF?text=Electrónicos',
                productCount: 25,
                lastUpdate: '2024-05-20'
            },
            {
                id: 2,
                name: 'Ropa y Moda',
                description: 'Prendas de vestir para hombre, mujer y niños. Incluye calzado y accesorios',
                image: 'https://via.placeholder.com/320x200/D4A853/FFFFFF?text=Ropa',
                productCount: 45,
                lastUpdate: '2024-05-18'
            },
            {
                id: 3,
                name: 'Hogar y Jardín',
                description: 'Artículos para el hogar, decoración, muebles y herramientas de jardín',
                image: 'https://via.placeholder.com/320x200/5DADE2/FFFFFF?text=Hogar',
                productCount: 32,
                lastUpdate: '2024-05-15'
            }
        ];

        let editingCategoryId = null;

        // Cargar categorías al iniciar
        document.addEventListener('DOMContentLoaded', function() {
            loadCategories();
            setupSearch();
            setupImagePreview();
        });

        function loadCategories() {
            const grid = document.getElementById('categoriesGrid');
            const emptyState = document.getElementById('emptyState');

            if (categories.length === 0) {
                grid.style.display = 'none';
                emptyState.style.display = 'block';
                return;
            }

            grid.style.display = 'grid';
            emptyState.style.display = 'none';

            grid.innerHTML = categories.map(category => `
                <div class="category-card" data-category-id="${category.id}">
                    <div class="category-image">
                        ${category.image ? `<img src="${category.image}" alt="${category.name}">` : `<i class="fas fa-image"></i>`}
                    </div>
                    <div class="category-content">
                        <h3 class="category-name">${category.name}</h3>
                        <p class="category-description">${category.description}</p>
                        
                        <div class="category-stats">
                            <div class="stat-item">
                                <div class="stat-number">${category.productCount}</div>
                                <div class="stat-label">Productos</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">${formatDate(category.lastUpdate)}</div>
                                <div class="stat-label">Actualizado</div>
                            </div>
                        </div>
                        
                        <div class="category-actions">
                            <button class="btn-edit" onclick="editCategory(${category.id})">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button class="btn-delete" onclick="deleteCategory(${category.id})">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function setupSearch() {
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const categoryCards = document.querySelectorAll('.category-card');
                
                categoryCards.forEach(card => {
                    const categoryName = card.querySelector('.category-name').textContent.toLowerCase();
                    const categoryDesc = card.querySelector('.category-description').textContent.toLowerCase();
                    
                    if (categoryName.includes(searchTerm) || categoryDesc.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        }

        function setupImagePreview() {
            const imageInput = document.getElementById('categoryImage');
            const imagePreview = document.getElementById('imagePreview');

            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function openAddModal() {
            editingCategoryId = null;
            document.getElementById('modalTitle').textContent = 'Nueva Categoría';
            document.getElementById('categoryForm').reset();
            document.getElementById('categoryId').value = '';
            document.getElementById('imagePreview').innerHTML = `
                <div class="upload-placeholder">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <div>Haz clic para subir una imagen</div>
                    <small>JPG, PNG o GIF (máx. 5MB)</small>
                </div>
            `;
        }

        function editCategory(id) {
            const category = categories.find(c => c.id === id);
            if (!category) return;

            editingCategoryId = id;
            document.getElementById('modalTitle').textContent = 'Editar Categoría';
            document.getElementById('categoryId').value = id;
            document.getElementById('categoryName').value = category.name;
            document.getElementById('categoryDescription').value = category.description;
            
            if (category.image) {
                document.getElementById('imagePreview').innerHTML = `<img src="${category.image}" alt="${category.name}">`;
            }

            const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
            modal.show();
        }

        function saveCategory() {
            const name = document.getElementById('categoryName').value.trim();
            const description = document.getElementById('categoryDescription').value.trim();
            const imageInput = document.getElementById('categoryImage');

            if (!name) {
                showNotification('Por favor ingresa un nombre para la categoría', 'error');
                return;
            }

            if (editingCategoryId) {
                // Actualizar categoría existente
                const categoryIndex = categories.findIndex(c => c.id === editingCategoryId);
                if (categoryIndex !== -1) {
                    categories[categoryIndex].name = name;
                    categories[categoryIndex].description = description;
                    categories[categoryIndex].lastUpdate = new Date().toISOString().split('T')[0];
                    
                    if (imageInput.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            categories[categoryIndex].image = e.target.result;
                            loadCategories();
                        };
                        reader.readAsDataURL(imageInput.files[0]);
                    } else {
                        loadCategories();
                    }
                    
                    showNotification('Categoría actualizada exitosamente', 'success');
                }
            } else {
                // Crear nueva categoría
                const newCategory = {
                    id: Math.max(...categories.map(c => c.id), 0) + 1,
                    name: name,
                    description: description,
                    image: null,
                    productCount: 0,
                    lastUpdate: new Date().toISOString().split('T')[0]
                };

                if (imageInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        newCategory.image = e.target.result;
                        categories.push(newCategory);
                        loadCategories();
                    };
                    reader.readAsDataURL(imageInput.files[0]);
                } else {
                    categories.push(newCategory);
                    loadCategories();
                }

                showNotification('Categoría creada exitosamente', 'success');
            }

            const modal = bootstrap.Modal.getInstance(document.getElementById('categoryModal'));
            modal.hide();
        }

        function deleteCategory(id) {
            const category = categories.find(c => c.id === id);
            if (!category) return;

            if (confirm(`¿Estás seguro de que deseas eliminar la categoría "${category.name}"?`)) {
                categories = categories.filter(c => c.id !== id);
                loadCategories();
                showNotification('Categoría eliminada exitosamente', 'success');
            }
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit' });
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            const alertClass = type === 'success' ? 'alert-success' : type === 'error' ? 'alert-danger' : 'alert-primary';
            notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
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

        // Navegación activa
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.getAttribute('href') === '#') {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>