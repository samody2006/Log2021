<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Rule;
use App\Models\Rider;

use Hash;

class RidersModel extends Model
{
    
    private $id;

    public function getUsers()
    {
        $products = DB::table('riders')->paginate(10);
        return $products;
    }

    public function setUser($post)
    {
        DB::table('riders')->insert([
            'name' => trim($post['name']),
            'email' => trim($post['email']),
            'phone' => trim($post['phone']),
            'riderNo' => $this->generateUniqueCode(),
            'password' => Hash::make(trim($post['password']))
        ]);
    }

    public function updateUser($post)
    {
        $password = false;
        if (mb_strlen(trim($post['password'], 'UTF-8')) > 0) {
            $password = $post['password'];
        }
        $this->id = $post['edit'];
        $update = [
            'name' => trim($post['name']),
            'email' => trim($post['email'])
        ];
        if ($password !== false) {
            $update['password'] = Hash::make(trim($post['password']));
        }
        DB::table('riders')->where('id', $this->id)->update($update);
    }

    public function getOneUser($id)
    {
        $user = DB::table('riders')->where('id', $id)->first();
        return $user;
    }

    public function deleteUser($id)
    {
        $this->id = $id;
        DB::table('riders')->where('id', $this->id)->delete();
    }

    public function generateUniqueCode()
    {
        do {
            $riderNo = random_int(10000, 99999);
        } while (Rider::where("riderNo", "=", $riderNo)->first());
  
        return $riderNo;
    }
}

