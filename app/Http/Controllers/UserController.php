<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $users;
    private $view;
    private $configPage;
    
    public function __construct(User $users)
    {
        $this->middleware('auth');
        
        $this->users = $users;
        $this->view = 'users';
        $this->configPage = 'users';
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configPage = $this->configPage;
        $users = $this->users->paginate(30);
        return view("{$this->view}.index", compact('users', 'configPage'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $configPage = $this->configPage;
        $data = $this->users->find($id);
        return view("{$this->view}.edit", compact('data', 'configPage'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        
    
        if (!$request->input('password')) {
            $input = $request->except('_token', '_method', 'password', 'password_confirmation');
        } else {
            $input = $request->except('_token', '_method');
        }
        $input['phone'] = preg_replace('/[^0-9]/', '', $input['phone']);
    
        if (isset($request->whatsapp)) {
            $input['whatsapp'] = 1;
        } else {
            $input['whatsapp'] = 0;
        }
    
        $data = $this->users->find($id);
        if ($data->update($input)) {
            return redirect()->route('usuarios.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->users->find($id);
        if ($data->delete()) {
            return redirect()->route('usuarios.index');
        }
    }
    
    
}
