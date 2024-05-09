<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(): Collection
    {
        return User::all();
    }
}
