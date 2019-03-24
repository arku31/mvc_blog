<?php
namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\User\UserRightException;
use App\Core\User\UserService;
use App\Core\Validator\Validator;
use App\Models\Post;

class BlogController
{
    /**
     * BlogController constructor.
     */
    public function __construct()
    {
        $userService = UserService::init();
        $userService->redirectIfNotAuthenticated();
    }

    /**
     * @param Request $request
     */
    public function index(Request $request)
    {
        $blogModel = new Post();
        $page = $request->getUriParam('page') ?? 1;
        $data['posts'] = $blogModel->byPage($page, 10);
        (new Response())->view('blog/index', $data);
    }

    /**
     * @param Request $request
     */
    public function view(Request $request)
    {
        $id = $request->getUriParam(3);
        $blogModel = new Post();
        $data['post'] =$blogModel->find($id);
        (new Response())->view('blog/view', $data);
    }

    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        (new Response())->view('blog/create', [
            'action' => '/blog/store',
            'errors' => Session::getOnce('errors')
        ]);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
        $post = new Post();
        $title = Validator::getSanitized($request->get('title'));
        $picture_url = Validator::getSanitized($request->get('picture_url'));
        $content = Validator::getSanitized($request->get('content'));
        $post->create($title, $picture_url, $content, user()['id']);

        (new Response())->redirect('blog');
    }

    /**
     * @param Request $request
     * @throws UserRightException
     * @throws \App\Core\Validator\ValidatorException
     */
    public function delete(Request $request)
    {
        $post = new Post();
        $postId = Validator::getNotEmptyVariable($request->getUriParam(3));
        if ($post->belongsTo($postId, user()['id'])) {
            $post->deleteById($postId);
        } else {
            throw new UserRightException();
        }
        (new Response())->redirect('blog');
    }

    /**
     * @param Request $request
     * @throws UserRightException
     * @throws \App\Core\Validator\ValidatorException
     */
    public function edit(Request $request)
    {
        $post = new Post();
        $postId = Validator::getNotEmptyVariable($request->getUriParam(3));

        if ($post->belongsTo($postId, user()['id'])) {
            $title = Validator::getSanitized($request->get('title'));
            $picture_url = Validator::getSanitized($request->get('picture_url'));
            $content = Validator::getSanitized($request->get('content'));
            $post->update($postId, $title, $picture_url, $content);
        } else {
            throw new UserRightException();
        }
    }

    public function update(Request $request)
    {
        $post = new Post();
        $postId = Validator::getNotEmptyVariable($request->getUriParam(3));

        if ($post->belongsTo($postId, user()['id'])) {
            (new Response())->view('blog/edit', [
                'action' => '/blog/store',
                'errors' => Session::getOnce('errors'),
                'post' => $post->find($postId)
            ]);
        } else {
            throw new UserRightException();
        }
    }
}