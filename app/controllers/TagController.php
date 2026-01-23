<?php

namespace App\Controllers;

use App\Middleware\Controller;
use App\Repositories\TagRepository;
use App\Models\Tag;

class TagController extends Controller
{
    private TagRepository $tagRepository;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->tagRepository = new TagRepository();
    }

    public function index()
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $tags = $this->tagRepository->all();

        $this->view('tags/index', [
            'user' => $user,
            'tags' => $tags,
            'page_title' => 'Manage Tags - TalentHub'
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
                'color' => $_POST['color'] ?? '#007bff'
            ];

            $tag = new Tag($data);
            
            if ($this->tagRepository->createTag($tag)) {
                $_SESSION['success'] = 'Tag created successfully';
                $this->redirect('/tags');
            } else {
                $_SESSION['error'] = 'Failed to create tag';
                $this->view('tags/create', [
                    'user' => $user,
                    'tag' => $tag,
                    'page_title' => 'Create Tag - TalentHub'
                ]);
            }
        } else {
            $this->view('tags/create', [
                'user' => $user,
                'tag' => new Tag(),
                'page_title' => 'Create Tag - TalentHub'
            ]);
        }
    }

    public function edit(int $id)
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $tag = $this->tagRepository->find($id);
        
        if (!$tag) {
            $_SESSION['error'] = 'Tag not found';
            $this->redirect('/tags');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tag->name = $_POST['name'] ?? $tag->name;
            $tag->color = $_POST['color'] ?? $tag->color;
            
            if ($this->tagRepository->updateTag($tag)) {
                $_SESSION['success'] = 'Tag updated successfully';
                $this->redirect('/tags');
            } else {
                $_SESSION['error'] = 'Failed to update tag';
                $this->view('tags/edit', [
                    'user' => $user,
                    'tag' => $tag,
                    'page_title' => 'Edit Tag - TalentHub'
                ]);
            }
        } else {
            $this->view('tags/edit', [
                'user' => $user,
                'tag' => $tag,
                'page_title' => 'Edit Tag - TalentHub'
            ]);
        }
    }

    public function delete(int $id)
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $tag = $this->tagRepository->find($id);
        
        if (!$tag) {
            $_SESSION['error'] = 'Tag not found';
            $this->redirect('/tags');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->tagRepository->delete($id)) {
                $_SESSION['success'] = 'Tag deleted successfully';
            } else {
                $_SESSION['error'] = 'Failed to delete tag';
            }
        }

        $this->redirect('/tags');
    }

    public function show(int $id)
    {
        $user = $this->getCurrentUser();
        if (!$user) {
            $this->redirect('/login');
        }

        $tag = $this->tagRepository->findByIdWithJobOffers($id);
        
        if (!$tag) {
            $_SESSION['error'] = 'Tag not found';
            $this->redirect('/tags');
        }

        $this->view('tags/show', [
            'user' => $user,
            'tag' => $tag,
            'page_title' => 'Tag Details - TalentHub'
        ]);
    }
}
