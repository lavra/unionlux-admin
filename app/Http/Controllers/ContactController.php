<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $view;
    private $contact;
    
    public function __construct(Contact $contact)
    {
        $this->middleware('auth');
        
        $this->view = 'contacts';
        $this->configPage = 'contacts';
    
        $this->contact = $contact;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configPage = $this->configPage;
        return view("{$this->view}.index", compact('configPage'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = $this->contact->find($id);
        
        ($contact->status == 1) ? $status = 0 : $status = 1;
        $data = ['status' => $status];
        if ($contact->update($data)) {
            $success = true;
            $message = 'Status alterado com sucesso!';
        } else {
            $success = true;
            $message = 'Não foi possível alterar o status!';
        }
        
        return response()->json(['success' => $success, 'status' => $status, 'message' => $message]);
    }

    
    
    /**
     * Get Contacts
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dataTable(Request $request)
    {
        $columns = array(
            
            0  => 'updated_at',
            1  => 'name',
            2  => 'email',
            3  => 'message',
            4  => 'status',
        );
        
        $totalData = $this->contact->count();
        $totalFiltered = $totalData;
        
        
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        
        
        if (empty($request->input('search.value'))) {
            $query = $this->contact
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            
            $query =  $this->contact->where('name','LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('message', 'LIKE',"%{$search}%")
                ->orWhere('updated_at', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
    
            $totalFiltered =  $this->contact->where('name','LIKE',"%{$search}%")
                ->orWhere('email', 'LIKE',"%{$search}%")
                ->orWhere('message', 'LIKE',"%{$search}%")
                ->orWhere('updated_at', 'LIKE',"%{$search}%")
                ->count();
        }
        
        $data  = array();
        if(!empty($query))
        {
            foreach ($query as $post){
    
                if( $post->status == 1 ) {
                    $status = '<a href="javascript:void(0)" id="btn-status-'.$post->id.'" data.status="1"  onclick="statusContact(\''.route('contatos.update', $post->id).'\', '.$post->id.')" class="btn btn-info"><i class="fa fa-check"></i></button>';
                } else {
                    $status = '<a href="javascript:void(0)"  id="btn-status-'.$post->id.'" data.status="0"  onclick="statusContact(\''.route('contatos.update', $post->id).'\', '.$post->id.')" class="btn btn-danger"><i class="fa fa-check"></i></button>';
                }
                //$actions = '<div class="btn-group" role="group" aria-label="Basic example">';
                    //$actions .= '<a href="'.route('contact.delete', $post->id).'" class="remove btn btn-danger"><i class="fa fa-trash"></i></button>';
                    //$actions .= '<a href="'.route('contatos.edit', $post->id).'" class="edit btn btn-info"><i class="fa fa-pencil-square-o"></i></button>';
                //$actions .= '</div>';
                
                $nData['updated_at']   = date('d/m/y', strtotime($post->updated_at));
                $nData['name']         = $post->name;
                $nData['email']        = $post->email;
                $nData['message']      = $post->message;
                $nData['status']       = $status;
                //$nData['actions']      = $actions;
                $data[] = $nData;
            }
        }
        
        $out = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        
        return response()->json($out);
    }
    
}
