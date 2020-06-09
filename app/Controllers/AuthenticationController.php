<?php
namespace App\Controllers;

use Config\Services;
use App\Entities\User;

class AuthenticationController extends BaseController
{

    public function notAuthorizedPage()
    {
        return view('authentication/not_authorized');
    }

    public function registerPage()
    {
        return view('authentication/register');
    }

    public function register()
    {
        $validationRuleSet = [
            'username' => 'required',
            'email' => 'valid_email',
            'password' => 'required|min_length[8]'
        ];

        $errorMessageList = [
            'username' => [
                'required' => 'Username is required'
            ],
            'email' => [
                'valid_email' => 'The email is not valid'
            ],
            'password' => [
                'required' => 'Password is required',
                'min_length' => 'Password must contain at least 8 characters'
            ]
        ];

        if (! $this->validate($validationRuleSet, $errorMessageList)) {
            return view('authentication/register', [
                'errors' => $this->validator->getErrors()
            ]);
        }

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->password = $password;

        $userModel = Services::userModel();
        $userModel->save($user);

        $userId = $userModel->getInsertID();

        $roleModel = Services::roleModel();

        $roleList = $roleModel->findByNameList([
            'post-read',
            'post-write'
        ]);

        $userRoleModel = Services::userRoleModel();

        for ($i = 0; $i < count($roleList); $i ++) {
            $userRoleModel->save([
                'user_id' => $userId,
                'role_id' => $roleList[$i]->id
            ]);
        }

        $response = $this->response;

        return $response->redirect(route_to(self::LOGIN_PAGE_ROUTE_ALIAS));
    }

    public function loginPage()
    {
        return view('authentication/login.php');
    }

    public function login()
    {
        $validationRuleSet = [
            'username' => 'required',
            'password' => 'required'
        ];

        $errorMessageList = [
            'username' => [
                'required' => 'Username is required'
            ],
            'password' => [
                'required' => 'Password is required'
            ]
        ];

        if (! $this->validate($validationRuleSet, $errorMessageList)) {
            return view('authentication/login', [
                'errors' => $this->validator->getErrors()
            ]);
        }

        $request = $this->request;

        $username = $request->getPost('username');
        $password = $request->getPost('password');

        $userModel = Services::userModel();

        $user = $userModel->findByUsername($username);

        if (is_null($user) || ! $user->login($password)) {
            return view('authentication/login', [
                'errors' => [
                    'Something bad happened'
                ]
            ]);
        }

        $session = Services::session();
        $session->set('principal', $user);

        $response = $this->response;

        return $response->redirect(route_to(PostController::LIST_PAGE_ROUTE_ALIAS));
    }

    public function logout()
    {
        $session = Services::session();
        $session->set('principal', null);

        $response = $this->response;

        return $response->redirect(route_to(self::LOGIN_PAGE_ROUTE_ALIAS));
    }

    const NOT_AUTHORIZED_PAGE_ROUTE_ALIAS = 'notAuthorizedPage';

    const REGISTER_PAGE_ROUTE_ALIAS = 'registerPage';

    const REGISTER_ROUTE_ALIAS = 'register';

    const LOGIN_PAGE_ROUTE_ALIAS = 'loginPage';

    const LOGIN_ROUTE_ALIAS = 'login';

    const LOGOUT_ROUTE_ALIAS = 'logout';
}