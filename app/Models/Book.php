<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['isbn', 'title', 'author', 'publication_date'];
    
    public function getAllBooks()
    {
        return $this->all();
    }
    
    public function getBookById($id)
    {
        return $this->find($id);
    }
}
