<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Psy\Util\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        dd(User::paginate(5)->toArray());
        return Inertia::render('Users/Index', [
            'title' => 'Users',
            'users' => UserResource::collection(User::orderByDesc('created_at')->paginate(5)),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Users/Create', [
            'title' => 'Users',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();

        if ($request->hasFile('images')) {
            $imgs = [];
            foreach ($request->file('images') as $img) {
                $ext = $img->extension();
                $file = \Illuminate\Support\Str::random(6) . '.' . $ext;
                $img->storeAs('public/customer', $file);
                $imgs[] = $file;
            }
        }

        $sI = implode(',', $imgs);

        $user->image = $sI;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'title' => 'Users',
            'user'  => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update(
            $request->validate([
                'name'  => 'required',
                'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            ])
        );

        session()->flash('message', 'запись успешно обновлена');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back();
    }
}
