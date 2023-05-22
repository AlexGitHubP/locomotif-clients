<?php

namespace Locomotif\Clients\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Locomotif\Clients\Models\Clients;
use Locomotif\Media\Controller\MediaController;
use Locomotif\Admin\Models\Users;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('authgate');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Clients::orderBy('ordering', 'desc')->get();
        foreach ($items as $key => $value) {
            $items[$key]->status_nice = mapStatus($value->status);
        }
        return view('clients::list')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //create new user
        $user = Users::create(['name' => $request->name,'email' => $request->email]);
        //set the role for the user
        setUserRole('client', $user->id);

        $request->validate([
            'name'    => 'required',
            'surname' => 'required',
            'email'   => 'required',
            'status'  =>'required'
        ]);
        
        $client = new Clients();

        $client->name         = $request->name;
        $client->user_id      = $user->id;
        $client->surname      = $request->surname;
        $client->email        = $request->email;
        $client->phone        = $request->phone;
        $client->url          = $request->url;
        $client->description  = $request->description;
        $client->ordering     = getOrdering($client->getTable(), 'ordering');
        $client->status       = $request->status;
        
        
        $client->save();

        return redirect('admin/clients/'.$client->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(Clients $clients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(Clients $client)
    {
        $associatedMedia      = app(MediaController::class)->mediaAssociations($client->getTable(), $client->id);
        return view('clients::edit')->with('item', $client)->with('associatedMedia', $associatedMedia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clients $client)
    {
        $request->validate([
            'name'    => 'required',
            'surname' => 'required',
            'email'   => 'required',
            'status'  =>'required'
        ]);
        
        $client->name         = $request->name;
        $client->surname      = $request->surname;
        $client->email        = $request->email;
        $client->phone        = $request->phone;
        $client->url          = $request->url;
        $client->description  = $request->description;
        $client->status       = $request->status;
        
        
        $client->save();

        return redirect('admin/clients/'.$client->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clients $clients)
    {
        //
    }
}
