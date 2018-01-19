<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Config;
use App\User;
use Mail;

class MailController extends Controller
{
    //
    public function index()
    {
    	return view('mail.index');
    }

    public function send_mailer(Request $request)
    {
    	$email = Config::where('director_email','like',$request->email)->first();

    	if($email)
    	{
            $cifrado = bcrypt('reestablecer password');


    		$data = [
    			'email' => $email->director_email,
    			'subject' => 'Recuperación de contraseña',
    			'bodyMessage' => 'Por favor acceda a esta ruta para restituir su contraseña '.config('app.url').'/farmacias/public/overwritePassword/'.$cifrado
    		];

    		Mail::send('mail.mail',$data,function($message) use ($data){
    			$message->from(config('app.user_mail'),' Gobernación del Estado Sucre');
                $message->to($data['email']);
                $message->subject($data['subject']);
    		});

            $user = User::where('id','=',$email->user_id)->first();

            $user->token_validation = $cifrado;
            $user->save();

            return redirect('/')->with([
                'flash_message' => 'Correo enviado con éxito, por favor verifique su email para continuar',
                'flash_class'   => 'alert-success'
            ]);
    	}
        else
        {
            return redirect()->route('mail.index')->with([
                'flash_message' => 'No se encuentra ningún registro igual al email typeado',
                'flash_class'   => 'alert-danger'
            ]);
        }
    }

    public function overwrite_password_view($cifrado)
    {
        $user = User::where('token_validation','=',$cifrado)->first();

        if($user)
        {
            return view('mail.overwritePassword')->with('user',$user);
        }
        else
        {
            return redirect('/')->with([
                'flash_message' => 'Token invalido',
                'flash_class'   => 'alert-danger'
            ]);
        }
    }

    public function overwrite_password(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->password = bcrypt($request->password);
        $user->token_validation = '';
        $user->save();

        return redirect('/')->with([
                'flash_message' => 'Contraseña Sobrescrita con éxito',
                'flash_class'   => 'alert-success'
            ]);
    }
}
