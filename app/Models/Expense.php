<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'expenditure';
    protected $fillable = [
    	'id',
    	'description',
    	'date_expense',
    	'price',
    	'id_user',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
