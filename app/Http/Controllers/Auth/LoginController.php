<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Http\Requests\LoginRequest;

use Illuminate\Http\RedirectResponse;

use Illuminate\View\View;

class LoginController extends Controller {

/** * * @return View */

public function showLoginForm(): View {

return view('/login');

}

/** * * @param LoginRequest $request * @return RedirectResponse */

public function processLogin(LoginRequest $request): RedirectResponse {
   $credentials = $request->only(['email', 'password']);
   $users = json_decode(file_get_contents(storage_path('demo-data/users.json')), true);
   $found = collect($users)->first(function($user) use ($credentials) {
      return $user['email'] === $credentials['email'] && $user['password'] === $credentials['password'];
   });
   if ($found) {
      session(['user' => $found]);
      return redirect()->route('orders');
   } else {
      session()->flash('error', 'Invalid credentials');
      return redirect()->route('login');
   }
}

}
