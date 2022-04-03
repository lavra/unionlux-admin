<?php

namespace App\Http\Controllers;

use App\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    private $view;
    private $newsletter;
    
    public function __construct(Newsletter $newsletter)
    {
        $this->middleware('auth');
    
        $this->view = 'newsletters';
        $this->configPage = 'newsletters';
        $this->newsletter = $newsletter;
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
        $newsletter = $this->newsletter->find($id);
       
        ($newsletter->active == 1) ? $active = 0 : $active = 1;
        $data = ['active' => $active];
        if ($newsletter->update($data)) {
            $success = true;
            $message = 'Status alterado com sucesso!';
        } else {
            $success = true;
            $message = 'Não foi possível alterar o status!';
        }
        
        return response()->json(['success' => $success, 'active' => $active, 'message' => $message]);
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
            2  => 'email',
            4  => 'active',
        );
        
        $totalData = $this->newsletter->count();
        $totalFiltered = $totalData;
        
        
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        
        
        if (empty($request->input('search.value'))) {
            $query = $this->newsletter
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            
            $query =  $this->newsletter->where('email','LIKE',"%{$search}%")
                ->orWhere('updated_at', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            
            $totalFiltered =  $this->newsletter->where('email','LIKE',"%{$search}%")
                ->orWhere('updated_at', 'LIKE',"%{$search}%")
                ->count();
        }
        
        $data  = array();
        if(!empty($query))
        {
            foreach ($query as $post){
                
                if( $post->active == 1 ) {
                    $active = '<a href="javascript:void(0)" id="btn-active-'.$post->id.'" data.active="1"  onclick="activeNewsletter(\''.route('newsletters.update', $post->id).'\', '.$post->id.')" class="btn btn-info"><i class="fa fa-check"></i></button>';
                } else {
                    $active = '<a href="javascript:void(0)"  id="btn-active-'.$post->id.'" data.active="0"  onclick="activeNewsletter(\''.route('newsletters.update', $post->id).'\', '.$post->id.')" class="btn btn-danger"><i class="fa fa-check"></i></button>';
                }
                //$actions = '<div class="btn-group" role="group" aria-label="Basic example">';
                //$actions .= '<a href="'.route('newsletter.delete', $post->id).'" class="remove btn btn-danger"><i class="fa fa-trash"></i></button>';
                //$actions .= '<a href="'.route('contatos.edit', $post->id).'" class="edit btn btn-info"><i class="fa fa-pencil-square-o"></i></button>';
                //$actions .= '</div>';
                
                $nData['updated_at']   = date('d/m/y', strtotime($post->updated_at));
                $nData['email']        = $post->email;
                $nData['active']       = $active;
                //$nData['actions']    = $actions;
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
