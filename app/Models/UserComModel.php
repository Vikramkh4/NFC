<?php

namespace App\Models;

use CodeIgniter\Model;

class UserComModel extends Model
{
    protected $table = 'usercommunity'; 
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['user_id', 'community_id','subcom_id']; 
}
