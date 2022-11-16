<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Psy\CodeCleaner\ReturnTypePass;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;

    }



    public function index(Request $request)
    {   

        #Filtros
        $search = $request->search; 
        $users = $this->model
                            ->getUsers(
                                search: $request->search ?? ''
                            ); 
        
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        if(!$user = $this->model->find($id)){
            return redirect()->route('users.index');
        }else{
            return view('users.show', compact('user'));
        }
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUpdateUserFormRequest $request)
    {   
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        
        if($request->image){
            $data['image']  = $request->image->store('users');
        }

        
        if($request->image){
            $data['image']  = $request->image->store('users');
        }

        $this->model->create($data); 
        return redirect()->route('users.index');
    }

    public function edit(string $id)
    {
        
        if(!$user = $this->model->find($id)){
            return redirect()->route('users.index');
        }else{
            return view('users.edit', compact('user'));
        }
    }

    public function update(StoreUpdateUserFormRequest $request, $id)
    {

        if(!$user = $this->model->find($id)){
            return redirect()->route('users.index');
        }else{

            $data = $request->only('name', 'email', 'image');

            if ($request->password){
                $data['password'] = bcrypt($request->password);
            }

            if($request->image){
                 #Apgar a imagem anterior
                if($user->image && Storage::exists($user->image)){
                    Storage::delete($user->image);
                }
                $data['image']  = $request->image->store('users');
            }
            
            $user->update($data);
            
            return redirect()->route('users.index');
        }
        
    }

    public function delete($id){
        if(!$user = $this->model->find($id))
            return redirect()->route('users.index');

        $this->model->destroy($id);
        return redirect()->route('users.index');
        
    }

}
