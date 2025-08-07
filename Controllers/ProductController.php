<?php
require_once 'Models/ProductModel.php';
class ProductController {
    private $model;
    public function __construct() { $this->model = new ProductModel(); }

    public function index() {
    $limit = 12;
    $page = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
    $offset = ($page - 1) * $limit;

    $filters = [
    'color'        => trim($_GET['color'] ?? ''),
    'size'         => trim($_GET['size'] ?? ''),
    'price_range'  => trim($_GET['price'] ?? ''),
    'danh_muc_id'  => trim($_GET['category'] ?? ''),
    'sort'         => trim($_GET['sort'] ?? ''),
    'keyword'      => trim($_GET['keyword'] ?? ''),
    'limit'        => $limit,
    'offset'       => $offset
];


    $products = $this->model->getFilteredProducts($filters);
    $totalProducts = $this->model->countFilteredProducts($filters); // <== mới, thay vì countAllProducts
    $totalPages = ceil($totalProducts / $limit);

    $categories = $this->model->getAllCategories();
    $listDanhMuc = $categories;
    $keyword = $filters['keyword'];

    require_once './views/product_list.php';
}


    public function adminList() {
        $products = $this->model->getAllProducts();
        include 'Views/admin_product_list.php';
    }

    public function add() {
        $categories = $this->model->getAllCategories();
        include 'Views/admin_product_create.php';
    }

    public function save() {
    $data = $_POST;
    $productId = $this->model->addProduct($data); // trả về id sản phẩm mới

    // Thêm biến thể màu + size
    $colors = $_POST['colors'] ?? [];
    $sizes = $_POST['sizes'] ?? [];

    foreach ($colors as $color) {
        foreach ($sizes as $size) {
            $this->model->addProductVariant($productId, $color, $size);
        }
    }

    header("Location: index.php?page=admin_products");
}


    public function edit($id) {
        $product = $this->model->getProductById($id);
        $categories = $this->model->getAllCategories();
        include 'Views/admin_product_edit.php';
    }

    public function update($id) {
        $data = $_POST;
        if (empty($data['gia_khuyen_mai']) || $data['gia_khuyen_mai'] <= 0 ||
            $data['gia_khuyen_mai'] > $data['gia_san_pham']) {
            $data['gia_khuyen_mai'] = $data['gia_san_pham'];
        }
        $this->model->updateProduct($id, $data);
        header("Location: index.php?page=admin_products");
    }

    public function delete($id) {
        $this->model->deleteProduct($id);
        header("Location: index.php?page=admin_products");
    }
}
