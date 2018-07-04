<?php

namespace App\Services;

use App\Models\User;

class UserService {
    
    public function __construct(){

    }

    public function getAllUsers(){
        $allUsers = User::all()->toArray();
        return $allUsers;
    }

    public function createUser($body){
        // var_dump($body);die();
        // $user = User::create([
        //     'name' => 'test',
        //     'surname' => 'new',
        //     'age' => 21
        // ]);  //this is not working
        // var_dump($user);die();
        try{
            $name = $body['name'];
            $surname = $body['surname'];
            // var_dump($body['age']);
            $age = (int) $body['age'];
            // var_dump($age);die();

            $user = new User;
            $user->name = $name;
            $user->surname = $surname;
            $user->age = $age;
            $user->save();
        } catch(Exception $e) {
            return false;
        }
        return true;
    }

    public function getUserById($id){
        $user = User::find($id);
        // echo '<pre>';
        // var_dump($user->toArray());die();
        return $user->toArray();
    }

    public function editUserById($id, $body){
        $user = User::find($id)->first();
        try{
            $user->name = $body['name'];
            $user->surname = $body['surname'];
            $user->age = (int) $body['age'];
            $user->save();
        } catch (Exception $e){
            return false;
        }

        return true;
    }

    public function deleteUser($id){
        try{
            User::destroy($id);
        } catch (Exception $e){
            return false;
        }
        return true;
    }
}