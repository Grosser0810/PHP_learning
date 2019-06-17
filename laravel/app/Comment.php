<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Comment extends Model
{
    public function post()
    {
        //привязываем комментарий к определенному посту
        return $this->hasOne(Post::class);
    }

    public function author()
    {
        //привязываем комментарий к определенному автору
        return $this->hasOne(User::class);
    }

    public function allow()
    {
        $this->status = 1;
        $this->save();
    }

    public function disallow()
    {
        $this->status = 0;
        $this->save();
    }

    public function toggleStatus()
    {
        if($this->status = 0){
            return $this->allow();
        }else{
            return $this->disallow();
        }
    }

    public function remove()
    {
        $this->delete();
    }
}