<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = 'categorynew';
    protected $primaryKey = 'id';
    protected $allowedFields = ['parent', 'name', 'slug', 'icon_class', 'thumbnail'];

    public function getCategories($category_id = 0)
    {
        if ($category_id > 0) {
            return $this->where('id', $category_id)->findAll();
        }
        return $this->findAll();
    }

    public function getSubCategories($category_id = 0)
    {
        if ($category_id > 0) {
            return $this->where('parent', $category_id)->where('parent >', '0')->findAll();
        }
        return $this->where('parent >', '0')->findAll();
    }
}
