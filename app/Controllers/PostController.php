<?php
namespace App\Controllers;

use Config\Services;
use App\Entities\Post;

class PostController extends BaseController
{

    public function listPage()
    {
        $postModel = Services::postModel();

        return view('post/list', [
            'data' => $postModel->findAllWithUser()
        ]);
    }

    public function addPage()
    {
        return view('post/new');
    }

    public function add()
    {
        $validationRuleSet = [
            'title' => 'required',
            'message' => 'required'
        ];

        $errorMessageList = [
            'title' => [
                'required' => 'Title is required'
            ],
            'message' => [
                'required' => 'Message is required'
            ]
        ];

        if (! $this->validate($validationRuleSet, $errorMessageList)) {
            return view('post/new', [
                'errors' => $this->validator->getErrors()
            ]);
        }

        $request = $this->request;

        $title = $request->getPost('title');
        $message = $request->getPost('message');

        $session = Services::session();

        $post = new Post();
        $post->title = $title;
        $post->message = $message;
        $post->userId = $session->get('principal')->id;

        $postModel = Services::postModel();
        $postModel->save($post);

        $response = $this->response;

        return $response->redirect(route_to(self::LIST_PAGE_ROUTE_ALIAS));
    }

    const LIST_PAGE_ROUTE_ALIAS = 'listPage';

    const ADD_PAGE_ROUTE_ALIAS = 'addPage';

    const ADD_ROUTE_ALIAS = 'add';
}

?>