<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class UserAuthenticateController extends Controller
{
    //

    public function index(): View
    {
        return view('front.user.login');
    }

    public function returnDashboard(): View
    {
        return view('front.home');
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->only('email', 'password');
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:1'
        ]);
        return $this->checkAdmin($validate, $credentials,  $request);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }

    private function checkAdmin(object $validate, array $credentials, Request $request): RedirectResponse
    {
        if ($validate->passes()) {

            if (auth()->guard('user')->attempt($credentials, $request->remember)) {
                return redirect()->route('front.home');
            } else {
                return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email', 'remember'));
            }
        } else {
            return redirect()->back()->withErrors($validate)->withInput($request->only('email', 'remember'));
        }
    }
}
