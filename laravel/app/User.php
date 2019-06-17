<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        // у пользователя может быть много постов
        return $this->hasMany(Post::class);
    }
    public function comments()
    {
        // у пользователя может быть много комментариев
        return $this->hasMany(Comment::class);
    }

    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->save();

        return $user;
    }

    public function generatePassword($passord)
    {
        if($passord != null){
            $this->password = bcrypt($passord);
        }
        $this->save();
    }

    public function edit($fields)
    {
        $this->fill($fields);


        $this->save();
    }

    public function remove()
    {
        $this->removeAvatar();
        $this->delete();
    }

    public function uploadAvatar($avatar)
    {
        if($avatar==null){
            return;
        }
        $this->removeAvatar();

        // сохронем картинку в папке uploads
        $filename = str_random(10) . '.' . $avatar->extension(); // генерируем случайное название файла
        $avatar->storeAs('uploads',$filename); // забрасываем файл в папку
        $this->avatar = $filename;
        $this->save();
    }

    public function removeAvatar()
    {
        if($this->avatar != null){
            Storage::delete('uploads/' . $this->avatar);  // проверем если есть картинка у этого поста
        }
    }

    public function  getImage()
    {
        if($this->avatar == null){
            return '/img/no-image.png';
        }
        return '/uploads/' . $this->avatar;
    }

    public function makeAdmin()
    {
        $this->is_admin = 1;
    }

    public function makeNormal()
    {
        $this->is_admin = 0;
    }

    public function toggleAdmin($value)
    {
        if($value == null){
            return $this->makeNormal();
        }else{
            return $this->makeAdmin();
        }
    }

    public function ban()
    {
        $this->status = 1;
        $this->save();
    }

    public function unban()
    {
        $this->status = 0;
        $this->save();
    }

    public function toggleBan($value)
    {
        if($value == null){
            return $this->unban();
        }else{
            return $this->ban();
        }
    }
}
