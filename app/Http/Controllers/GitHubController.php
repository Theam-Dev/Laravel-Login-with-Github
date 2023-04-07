<?php

namespace App\Http\Controllers;

use Auth;
use Exception;
use Socialite;
use App\Models\User;

class GitHubController extends Controller
{
    public function gitHubLogin()
    {
        return Socialite::driver('github')->redirect();
    }
       

    public function gitHubCallback()
    {
        try {
     
            $user = Socialite::driver('github')->user();
      
            $searchUser = User::where('github_id', $user->id)->first();
      
            if($searchUser){
      
                Auth::login($searchUser);
     
                return redirect('/dashboard');
      
            }else{
                $gitUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'github_id'=> $user->id,
                    'auth_type'=> 'github',
                    'password' => encrypt('git12345')
                ]);
     
                Auth::login($gitUser);
      
                return redirect('/dashboard');
            }
     
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
