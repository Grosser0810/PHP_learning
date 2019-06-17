<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use Sluggable;

    protected $fillable = ['title','content','date','description'];

    public function category()
    {
        //указываем что у поста есть категория
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        //указывам что у поста есть автор
        return $this->belongsTo(User::class,'user_id');
    }

    public function tags()
    {
        //создаем свзь многие ко многим(посты - теги)
        return $this->belongsToMany(
            Tag::class,
            'posts_tags',
            'post_id',
            'tag_id'
        );
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function add($fields)
    {
        // добавить пост
        $post = new static;
        $post->fill($fields); //массовое присвоение
        $post->user_id = 1;
        $post->save();

        return $post;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        // удоляем картинку поста(что бы избавиться от хлама)
        Storage::delete('uploads/' . $this->image);
        // удоление поста
        $this->delete();
    }

    public function uploadImage($image)
    {
        if($image==null){
            return;
        }
        Storage::delete('uploads/' . $this->image);  // проверем если есть картинка у этого поста перед загрузкой новой то удаляем ее
        // сохронем картинку в папке uploads
        $filename = str_random(10) . '.' . $image->extension(); // генерируем случайное название файла
        $image->storeAs('uploads',$filename); // забрасываем файл в папку
        $this->image = $filename;
        $this->save();
    }

    public function getImage()
    {
        //получаем путь картинки
        if($this->image == null){
            return '/img/no-image.phg';
        }
        return '/uploads/' . $this->image;
    }

    public function setCategory($id)
    {
        if($id==null){
            return;
        }
        $this->category_id = $id;
        $this->save();
    }

    public function setTags($ids)
    {
        if($ids==null){
            $this->tags()->sync($ids);
        }
    }

    public function setDraft()
    {
        // переводим пост в черновик
        $this->status = 0;
        $this->save();
    }

    public function setPublic()
    {
        // переводим пост в доступный вид(паблик)
        $this->stats = 1;
        $this->save();
    }

    public function toggleStatus($value)
    {
        // переключатель статусов
        if($value == null){
            return $this->setDraft();
        }else{
            return $this->setPublic();
        }
    }

    public function setDateAtribute($value)
    {
        $date = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d');
        $this->attributes['date'] = $date;
    }

    public function getCategoryTitle()
    {
        if($this->category != null)
        {
            return $this->category->title;
        }

        return 'Без категории';
    }

    public function getTagsTittles()
    {
        if(!$this->tags->isEmpty())
        {
            return implode(', ', $this->tags->pluck('title')->all());
        }

        return 'Нет тэгов';
}
    public function getCategoryID()
    {
        return $this->category != null ? $this->category->id : null;

    }


}