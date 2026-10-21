<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::withCount('articles')->orderBy('id')->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:150|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:admin,editor',
        ]);

        User::create($data);

        return redirect()->route('admin.users.index')->with('status', 'Đã thêm người dùng.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['user' => 'Không thể xóa chính mình.']);
        }

        if ($user->articles()->exists()) {
            return back()->withErrors(['user' => 'Không thể xóa người dùng đang có bài viết.']);
        }

        $user->delete();

        return back()->with('status', 'Đã xóa người dùng.');
    }
}
