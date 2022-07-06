<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Model;
use app\core\Request;
use app\models\User;

class UserController extends Controller {

    public function dashboard()
    {
        $user = new User;
        $db = $user->db;
        $users = $db->row('SELECT * FROM users');


        return $this->render('dashboard', [
            'users' => $users
        ]);
    }

    public function profile()
    {
        return $this->render('profile');
    }

    public function login(Request $request)
    {
        if ($request->isPost()) {
            return 'Handle submitted data';
        }
        // $_SESSION['admin'] = 1;
        if ($_SESSION['admin'] === 1) {
            header('Location: /admin');
        }
        $this->setLayout('admin');

        return $this->render('login');
    }

    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());

            // Check data for validation & create new user
            if ($user->validate() && $user->register($request->getBody())) {
                
                Application::$app->session->setFlash('success', 'User successfully created');
                Application::$app->response->redirect('/admin');
                exit();
            }
            // Application::$app->session->setFlash('success', 'User successfully created');
            return $this->render('register', [
                'user' => $user
            ]);
        } 
        $this->setLayout('admin');

        return $this->render('register', [
            'user' => $user
        ]);
    }
}