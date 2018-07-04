<?php

namespace App\Controllers;

// use App\Models\User;
use App\Application;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController {

    private $twig;
    private $userService;

    public function __construct($twig, $userService){
        $this->twig = $twig;
        $this->userService = $userService;
    }

    public function listUsers(Request $request){
        // $allUsers = User::all()->toArray();
        // echo '<pre>';
        // var_dump($allUsers);die();
        $users = $this->userService->getAllUsers();        
        // echo '<pre>';
        // var_dump($users);die();

        $message = $request->getQueryParams('message'); //include the error message in the render
        // var_dump($message['message']);die();
        return $this->twig->render('list.twig', ['users' => $users, 'message' => $message['message']]);

    }

    public function createDisplay(){
        return $this->twig->render('create.twig');
    }

    public function createUser(Request $request, Response $response){
        // echo '<pre>';
        // var_dump($request);
        $body = $request->getParsedBody();
        // var_dump($body);die();
        $success = $this->userService->createUser($body);
        if($success){
            // $users = $this->userService->getAllUsers();
            // return $this->twig->render('list.twig', ['users' => $users]);
            return $response->withStatus(302)->withHeader('Location', '/');
            //when the page is refreshed, only the last function call will be executed (getAllusers())
            //instead if re-submitting the whole form
        }
        return $this->twig->render('create.twig', ['message' => 'User is not Created, please try again!']);
    }

    public function editDisplay(Request $request, Response $response, $id){
        // var_dump($response);die();
        $user = $this->userService->getUserById($id);
        $newUser = $user[0];
        return $this->twig->render('edit.twig', ['user' => $newUser]);
    }

    public function editUser(Request $request, Response $response, $id){
        $body = $request->getParsedBody();
        $success = $this->userService->editUserById($id, $body);
        // var_dump($success);die();
        if($success){
            return $response->withStatus(302)->withHeader('Location', '/');
        }
        return $response->withStatus(302)->withHeader('Location', '/user/edit/'.$id);
    }

    public function deleteUser(Request $request, Response $response, $id){
        // $success = $this->userService->deleteUser($id);
        $success = false;
        if($success){
            return $response->withStatus(302)->withHeader('Location', '/');
        }
        return $response->withStatus(302)->withHeader('Location', '/?message=Delete failed');
    }

    

}