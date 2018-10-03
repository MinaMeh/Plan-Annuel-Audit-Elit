<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Userapp;
use App\Application;
use App\Serveur;

class ApplicationsController extends Controller
{
    public function addUserServer(Request $request)
    {
        if ($request->ajax()){
            $this->validate(request(),[
            'addresse_ip'=>'required|ip',
            'port'=>'required|numeric',
            'user'=>'regex:/^[a-zA-Z0-9\s]+$/|max:15',
            'password'=>'regex:/^[a-zA-Z0-9\s]+$/|max:30',
            'user_ssh'=>'regex:/^[a-zA-Z0-9\s]+$/|max:15',
            'password_ssh'=>'regex:/^[a-zA-Z0-9\s]+$/|max:30',
            'tech'=>'regex:/^[a-zA-Z0-9\s]+$/|max:20'
        ]);
            Serveur::create([
                'application_id'=>request('app_id'),
                'addresse_ip'=>request('addresse_ip'),
                'port'=>request('port'),
                'user'=>request('user'),
                'password'=>request('password'),
                'user_ssh'=>request('user_ssh'),
                'password_ssh'=>request('password_ssh'),
                'tech'=>request('tech')
               
            ]);
                        
        }   
    }
    public function showUserServers()
    {
        $serveurs=Application::find(request('app_id'))->serveurs;
        $output='';
       
            foreach ($serveurs as $serveur) {
                $output.='<tr>
                        <td contenteditable   class="ip_address" data-id1="'.$serveur->id.'" >'.$serveur->addresse_ip.'</td>'.
                        '<td contenteditable   class="port"data-id2="'.$serveur->id.'">'.$serveur->port.'</td>'.
                        '<td contenteditable  class="user_server" data-id3="'.$serveur->id.'">'.$serveur->user.'</td>'.
                        '<td contenteditable  class="password_server" data-id4="'.$serveur->id.'">'.$serveur->password.'</td>'.
                        '<td contenteditable  class="user_ssh"data-id5="'.$serveur->id.'">'.$serveur->user_ssh.'</td>'.
                        '<td contenteditable  class="password_ssh"data-id6="'.$serveur->id.'">'.$serveur->password_ssh.'</td>'.
                        '<td contenteditable  class="tech" data-id7="'.$serveur->id.'">'.$serveur->tech.'</td>'.
                       ' <td width="50"><button type="button" class="btn btn-danger btn-sm btn_del" name="btn_delete id="btn_del data-id8="'.$serveur->id.'">'.'<span class="fa fa-minus-circle">'.'</button></td></tr>';
            }

        
        $output.='<tr contenteditable>
                    <td id="addresse_ip"  class="addresse_ip"></td>
                    <td id="port" class="port"></td>
                    <td id="user_server" class="user_server"></td>
                    <td id="password_server" class="password_server"></td>
                    <td id="user_ssh" class="user_ssh"></td>
                    <td id="password_ssh" class="password_ssh"></td>
                    <td id="tech" class="tech"></td>

                    <td width="50"><button type="button" name="btn_add" class="btn btn-success btn-sm" id="btn-info" onclick="addUserServer($('."'#apps_list'".').val())"><span class="fa fa-plus-circle"></span></button></td>
                </tr>';
        return Response($output);
    }
    public function addUserApp(Request $request)
    {
    	if ($request->ajax()){
            $this->validate(request(),[
            'user'=>'required|regex:/^[a-zA-Z0-9\s]+$/|max:30',
            'password'=>'regex:/^[a-zA-Z0-9\s]+$/|max:30',
            'role'=>'regex:/^[a-zA-Z0-9\s]+$/|max:15'
            
        ]);
    		Userapp::create([
       			'username'=>request('user'),
    			'password'=>request('password'),
    			'role'=>request('role'),
    			'application_id'=>request('app_id')
    		]);
    		
    		return (Response('done'));
    	}
    	else {
    		return (Response('echec'));
    	}
    	
    }
    public function showUserApp(Request $request)
    {

        
    	$users=Application::find(request('app_id'))->appusers->all();
    	$output='';
    	

	    	foreach ($users as $user) {
	    		$output.='<tr>
	    				<td contenteditable class="text-center username"   data-id1="'.$user->id.'" >'.$user->username.'</td>'.
	    				'<td contenteditable class="text-center password"  data-id2="'.$user->id.'">'.$user->password.'</td>'.
	    				'<td contenteditable class="text-cente role"  data-id3="'.$user->id.'">'.$user->role.'</td>
	    				<td><button type="button" class="btn btn-danger btn-sm btn_delete" name="btn_delete id="btn_delete data-id4="'.$user->id.'">'.'<span class="fa fa-minus-circle">'.'</button></td></tr>';
	    	}

    	
    	$output.='<tr contenteditable="true">
										<td class="text-center username"  id="user"></td>
										<td class="text-center password" id="password"></td>
										<td class="text-cente role" id="role"></td>
	<td> <button type="button" name="btn_add" class="btn btn-success btn-sm" id="btn-info" onclick="addUserApp($('."'#apps_list'".').val())"><span class="fa fa-plus-circle"></span></button></td>
									</tr>';
		return Response($output);
    }
    public function updateAppUser(Request $request)
    {
    	$appuser=Userapp::find(request('id'));
    	$appuser->update([request('colomn')=>request('val')]);
    	return Response([request('colomn').'=>'.request('val')]);
    }
    public function deleteAppUser(Request $request)
    {
    	$appuser=Userapp::find(request('id'));
    	$appuser->delete();
    }
     public function deleteAppServer(Request $request)
    {
        $serveur=Serveur::find(request('id'));
        $serveur->delete();
    }
     public function updateAppServer(Request $request)
    {
        $serveur=Serveur::find(request('id'));
        $serveur->update([request('colomn')=>request('val')]);
        return Response([request('colomn').'=>'.request('val')]);
    }

}
    