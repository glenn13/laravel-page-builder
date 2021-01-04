<?php

namespace App\Models;

class PageBuilder extends Model 
{ 
    protected $table = "pagebuilder__pages"; 
    protected $fillable = ['name', 'layout', 'data'];
}