<?php
require_once 'Models/ProductModel.php';

class CategoryController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ProductModel();
    }

    public function index()
    {
        $categories = $this->model->getAllCategories();
        // Lọc chỉ danh mục hiện
        $categories = array_filter($categories, function($cat) {
            return isset($cat['trang_thai']) && $cat['trang_thai'] == 1;
        });
        include 'Views/category_list.php';
    }

    public function add()
    {
        include 'Views/category_form.php';
    }

    public function save()
    {
        if (isset($_POST['ten_danh_muc'])) {
            $data = [
                'ten_danh_muc' => $_POST['ten_danh_muc'],
                'mo_ta' => $_POST['mo_ta'] ?? '',
                'trang_thai' => $_POST['trang_thai'] ?? 1,
            ];
            $this->model->addCategory($data);
        }
        header("Location: index.php?page=category");
    }

    public function edit($id)
    {
        $category = $this->model->getCategoryById($id);
        include 'Views/category_form.php';
    }

    public function update($id)
    {
        if (isset($_POST['ten_danh_muc'])) {
            $data = [
                'ten_danh_muc' => $_POST['ten_danh_muc'],
                'mo_ta' => $_POST['mo_ta'] ?? '',
                'trang_thai' => $_POST['trang_thai'] ?? 1,
            ];
            $this->model->updateCategory($id, $data);
        }
        header("Location: index.php?page=category");
    }

    public function delete($id)
    {
        $this->model->deleteCategory($id);
        header("Location: index.php?page=category");
    }
}
