<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\CategoryRepository;
use App\Core\Database;
use App\Models\User;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    private CategoryRepository $categories;
    private User $userModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->categories = new CategoryRepository();
        $this->userModel  = new User(Database::connection());
    }

    private function requireAdmin(): void
    {
        if (!$this->isLoggedIn() || ($_SESSION['role'] ?? '') !== 'admin') {
            $this->redirect('/403');
        }
    }

    private function currentUser(): ?array
    {
        if (!isset($_SESSION['user_id'])) {
            return null;
        }

        return $this->userModel->findById((int) $_SESSION['user_id']);
    }

    public function index(): void
    {
        $this->requireAdmin();

        $user       = $this->currentUser();
        $categories = $this->categories->all(); // Category[]

        $this->view('admin/categories/index', [
            'user'       => $user,
            'page_title' => 'Manage Categories - TalentHub',
            'categories' => $categories,
        ]);
    }

    public function create(): void
    {
        $this->requireAdmin();

        $user  = $this->currentUser();
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        $this->view('admin/categories/create', [
            'user'       => $user,
            'page_title' => 'Create Category - TalentHub',
            'error'      => $error,
        ]);
    }

    public function store(): void
    {
        $this->requireAdmin();

        $name = trim($_POST['name'] ?? '');

        if ($name === '') {
            $_SESSION['error'] = 'Category name is required.';
            $this->redirect('/admin/categories/create');
        }

        try {
            $category = (new Category())->setName($name);
        } catch (\InvalidArgumentException $e) {
            $_SESSION['error'] = $e->getMessage();
            $this->redirect('/admin/categories/create');
        }

        $this->categories->create($category);
        $this->redirect('/admin/categories');
    }

    public function edit(): void
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect('/admin/categories');
        }

        $category = $this->categories->find($id); // Category|null
        $user     = $this->currentUser();

        if (!$category) {
            $this->redirect('/admin/categories');
        }

        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        $this->view('admin/categories/edit', [
            'user'       => $user,
            'page_title' => 'Edit Category - TalentHub',
            'category'   => $category,
            'error'      => $error,
        ]);
    }

    public function update(): void
    {
        $this->requireAdmin();

        $id   = (int) ($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');

        if ($id <= 0 || $name === '') {
            $_SESSION['error'] = 'Invalid data.';
            $this->redirect('/admin/categories');
        }

        try {
            $category = (new Category())
                ->setId($id)
                ->setName($name);
        } catch (\InvalidArgumentException $e) {
            $_SESSION['error'] = $e->getMessage();
            $this->redirect('/admin/categories');
        }

        $this->categories->update($category);
        $this->redirect('/admin/categories');
    }

    public function destroy(): void
    {
        $this->requireAdmin();

        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            $this->categories->delete($id);
        }

        $this->redirect('/admin/categories');
    }
}
