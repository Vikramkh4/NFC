<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $DBGroup = 'default'; // Database group name
    protected $table = 'category'; // Name of the database table
    protected $primaryKey = 'id'; // Corrected without extra space
    protected $useAutoIncrement = true; // Auto-increment for the primary key
    protected $insertID = 0; // Default insert ID
    protected $returnType = 'array'; // Return data as an array
    protected $useSoftDeletes = false; // Soft deletes not enabled
    protected $protectFields = true; // Protect fields from mass assignment
    protected $allowedFields = [
        'name', // Removed 'id' since it's typically auto-incremented
        'brand_id',
        'description',
        'creat_date', // Use 'created_at' for consistency
    ];

   
}

