<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use App\Models\RoleModel;
use App\Controllers\AuthenticationController;

class AuthenticationFilter implements FilterInterface
{

    public function before(RequestInterface $request)
    {
        $params = func_get_args();
        $roles = count($params) > 1 && is_array($params[1]) ? $params[1] : array();
        $session = Services::session();
        if (! $session->has('principal')) {
            $response = Services::response();
            return $response->redirect(route_to(AuthenticationController::LOGIN_PAGE_ROUTE_ALIAS));
        }
        $principal = $session->get('principal');
        if (! $principal->hasRole($roles, new RoleModel())) {
            $response = Services::response();
            return $response->redirect(route_to(AuthenticationController::NOT_AUTHORIZED_PAGE_ROUTE_ALIAS));
        }
        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        return $response;
    }
}