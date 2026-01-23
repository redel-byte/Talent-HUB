<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Repositories\TagRepository;
use App\Core\Database;
use App\Models\User;
use App\Models\Tag;

class AdminTagController extends Controller
{
    private TagRepository $tags;
    private User $userModel;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->tags      = new TagRepository();
        $this->userModel = new User(Database::connection());
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

        $user = $this->currentUser();
        $tags = $this->tags->all(); 

        $this->view('admin/tags/index', [
            'user'       => $user,
            'page_title' => 'Manage Tags - TalentHub',
            'tags'       => $tags,
        ]);
    }

    public function create(): void
    {
        $this->requireAdmin();

        $user  = $this->currentUser();
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        $this->view('admin/tags/create', [
            'user'       => $user,
            'page_title' => 'Create Tag - TalentHub',
            'error'      => $error,
        ]);
    }

    public function store(): void
    {
        $this->requireAdmin();

        $name = trim($_POST['name'] ?? '');

        if ($name === '') {
            $_SESSION['error'] = 'Tag name is required.';
            $this->redirect('/admin/tags/create');
        }

        try {
            $tag = (new Tag())->setName($name);
        } catch (\InvalidArgumentException $e) {
            $_SESSION['error'] = $e->getMessage();
            $this->redirect('/admin/tags/create');
        }

        $this->tags->create($tag);
        $this->redirect('/admin/tags');
    }

    public function edit(): void
    {
        $this->requireAdmin();

        $id = (int) ($_GET['id'] ?? 0);
        if ($id <= 0) {
            $this->redirect('/admin/tags');
        }

        $tag  = $this->tags->find($id); 
        $user = $this->currentUser();

        if (!$tag) {
            $this->redirect('/admin/tags');
        }

        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        $this->view('admin/tags/edit', [
            'user'       => $user,
            'page_title' => 'Edit Tag - TalentHub',
            'tag'        => $tag,
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
            $this->redirect('/admin/tags');
        }

        try {
            $tag = (new Tag())
                ->setId($id)
                ->setName($name);
        } catch (\InvalidArgumentException $e) {
            $_SESSION['error'] = $e->getMessage();
            $this->redirect('/admin/tags');
        }

        $this->tags->update($tag);
        $this->redirect('/admin/tags');
    }

    public function destroy(): void
    {
        $this->requireAdmin();

        $id = (int) ($_POST['id'] ?? 0);
        if ($id > 0) {
            $this->tags->delete($id);
        }

        $this->redirect('/admin/tags');
    }
}
