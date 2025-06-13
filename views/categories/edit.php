<?php
require_once '../../config/config.php';
require_once '../../config/database.php';

// Verificar si el usuario está logueado y es administrador
if (!isLoggedIn() || !isAdmin()) {
    redirect('../auth/login.php');
}

// Verificar si se proporcionó un ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    redirect('index.php');
}

$category_id = (int)$_GET['id'];
$database = new Database();
$db = $database->getConnection();

// Obtener datos de la categoría
$query = "SELECT * FROM categories WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->execute([$category_id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

// Si la categoría no existe, redirigir
if (!$category) {
    redirect('index.php');
}

$error = '';
$success = '';

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar y limpiar datos
    $name = cleanInput($_POST['name']);
    $description = cleanInput($_POST['description']);
    
    // Validar nombre (obligatorio)
    if (empty($name)) {
        $error = 'El nombre de la categoría es obligatorio';
    } else {
        // Procesar imagen si se ha subido una nueva
        $image_name = $category['image']; // Mantener la imagen actual por defecto
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['image']['name'];
            $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            // Verificar extensión
            if (!in_array(strtolower($file_ext), $allowed)) {
                $error = 'Formato de imagen no permitido. Use: jpg, jpeg, png o gif';
            } else {
                // Generar nombre único para la imagen
                $image_name = uniqid() . '.' . $file_ext;
                $target_path = "../../assets/images/categories/" . $image_name;
                
                // Crear directorio si no existe
                if (!file_exists("../../assets/images/categories/")) {
                    mkdir("../../assets/images/categories/", 0777, true);
                }
                
                // Mover archivo subido
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                    $error = 'Error al subir la imagen';
                    $image_name = $category['image']; // Mantener la imagen anterior si hay error
                } else {
                    // Eliminar imagen anterior si existe
                    if ($category['image'] && file_exists("../../assets/images/categories/" . $category['image'])) {
                        unlink("../../assets/images/categories/" . $category['image']);
                    }
                }
            }
        }
        
        // Si no hay errores, actualizar en la base de datos
        if (empty($error)) {
            $query = "UPDATE categories SET name = ?, description = ?, image = ? WHERE id = ?";
            $stmt = $db->prepare($query);
            
            if ($stmt->execute([$name, $description, $image_name, $category_id])) {
                $success = 'Categoría actualizada correctamente';
                
                // Actualizar datos de la categoría para mostrar los cambios
                $category['name'] = $name;
                $category['description'] = $description;
                $category['image'] = $image_name;
            } else {
                $error = 'Error al actualizar la categoría';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría - Catálogo de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="../../assets/css/custom.css" rel="stylesheet">
</head>
<body>
    <?php include '../../includes/nav.php'; ?>

    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h4 class="mb-0"><i class="fas fa-edit"></i> Editar Categoría</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i> <?php echo $error; ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($success): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> <?php echo $success; ?>
                            <div class="mt-2">
                                <a href="index.php" class="btn btn-sm btn-primary">
                                    <i class="fas fa-list"></i> Ver todas las categorías
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <form id="categoryForm" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre de la Categoría *</label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       value="<?php echo htmlspecialchars($category['name']); ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea class="form-control" id="description" name="description" 
                                          rows="3"><?php echo htmlspecialchars($category['description']); ?></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="image" class="form-label">Imagen de la Categoría</label>
                                
                                <?php if ($category['image']): ?>
                                <div class="mb-2 text-center">
                                    <p>Imagen actual:</p>
                                    <img src="../../assets/images/categories/<?php echo $category['image']; ?>" 
                                         class="img-fluid img-thumbnail" style="max-height: 200px;" 
                                         alt="<?php echo htmlspecialchars($category['name']); ?>">
                                </div>
                                <?php endif; ?>
                                
                                <input type="file" class="form-control" id="image" name="image" 
                                       accept="image/jpeg,image/png,image/gif" data-preview="imagePreview">
                                <div class="form-text">Deje este campo vacío para mantener la imagen actual.</div>
                                
                                <div class="mt-2 text-center">
                                    <img id="imagePreview" class="img-fluid img-thumbnail" 
                                         style="max-height: 200px; display: none;" alt="Vista previa">
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> Actualizar Categoría
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/app.js"></script>
    <script>
        // Vista previa de la imagen
        document.getElementById('image').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
        
        // Validación del formulario
        document.getElementById('categoryForm').addEventListener('submit', function(e) {
            const nameInput = document.getElementById('name');
            if (!nameInput.value.trim()) {
                e.preventDefault();
                nameInput.classList.add('is-invalid');
                alert('El nombre de la categoría es obligatorio');
            }
        });
    </script>
</body>
</html>