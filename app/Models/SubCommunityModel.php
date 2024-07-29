<?php

namespace App\Models;

use CodeIgniter\Model;

class SubCommunityModel extends Model
{
    protected $table = 'subcommunity';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'community_id',
        'sub_name',
        'sub_description',
        'image',
        'tags',
        'createdby',
        'create_date',
        
    ];

}
