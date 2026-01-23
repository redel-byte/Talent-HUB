<?php

namespace App\Controllers;

use App\Middleware\Controller;
use App\Repositories\CategoryRepository;
use App\Models\Category;

class CategoryController extends Controller
{
    private CategoryRepository $categoryRepository;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->categoryRepository = new CategoryRepository();
    }

    public function index()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $categories = $this->categoryRepository->all();

        $this->view('categories/index', [
            'user' => $user,
            'categories' => $categories,
            'page_title' => 'Manage Categories - TalentHub'
        ]);
    }

    public function create()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? ''
            ];

            $category = new Category($data);
            
            if ($this->categoryRepository->createCategory($category)) {
                $_SESSION['success'] = 'Category created successfully';
                $this->redirect('/categories');
            } else {
                $_SESSION['error'] = 'Failed to create category';
                $this->view('categories/create', [
                    'user' => $user,
                    'category' => $category,
                    'page_title' => 'Create Category - TalentHub'
                ]);
            }
        } else {
            $this->view('categories/create', [
                'user' => $user,
                'category' => new Category(),
                'page_title' => 'Create Category - TalentHub'
            ]);
        }
    }

    public function edit(int $id)
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $category = $this->categoryRepository->find($id);
        
        if (!$category) {
            $_SESSION['error'] = 'Category not found';
            $this->redirect('/categories');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category->name = $_POST['name'] ?? $category->name;
            $category->description = $_POST['description'] ?? $category->description;
            
            if ($this->categoryRepository->updateCategory($category)) {
                $_SESSION['success'] = 'Category updated successfully';
                $this->redirect('/categories');
            } else {
                $_SESSION['error'] = 'Failed to update category';
                $this->view('categories/edit', [
                    'user' => $user,
                    'category' => $category,
                    'page_title' => 'Edit Category - TalentHub'
                ]);
            }
        } else {
            $this->view('categories/edit', [
                'user' => $user,
                'category' => $category,
                'page_title' => 'Edit Category - TalentHub'
            ]);
        }
    }

    public function delete(int $id)
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $category = $this->categoryRepository->find($id);
        
        if (!$category) {
            $_SESSION['error'] = 'Category not found';
            $this->redirect('/categories');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->categoryRepository->delete($id)) {
                $_SESSION['success'] = 'Category deleted successfully';
            } else {
                $_SESSION['error'] = 'Failed to delete category';
            }
        }

        $this->redirect('/categories');
    }

    public function show(int $id)
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $category = $this->categoryRepository->findByIdWithJobOffers($id);
        
        if (!$category) {
            $_SESSION['error'] = 'Category not found';
            $this->redirect('/categories');
        }

        $this->view('categories/show', [
            'user' => $user,
            'category' => $category,
            'page_title' => 'Category Details - TalentHub'
        ]);
    }

    public function archive(int $id)
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $category = $this->categoryRepository->find($id);
        
        if (!$category) {
            $_SESSION['error'] = 'Category not found';
            $this->redirect('/categories');
        }

        if ($this->categoryRepository->archive($id)) {
            $_SESSION['success'] = 'Category archived successfully';
        } else {
            $_SESSION['error'] = 'Failed to archive category';
        }

        $this->redirect('/categories');
    }

    public function unarchive(int $id)
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $category = $this->categoryRepository->find($id);
        
        if (!$category) {
            $_SESSION['error'] = 'Category not found';
            $this->redirect('/categories');
        }

        if ($this->categoryRepository->unarchive($id)) {
            $_SESSION['success'] = 'Category unarchived successfully';
        } else {
            $_SESSION['error'] = 'Failed to unarchive category';
        }

        $this->redirect('/categories');
    }
}
