<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdminLoginController extends Controller
{
    public function index(): View
    {
        return view('admin.login');
    }

    public function returnDashboard(): View
    {
        return view('admin.dashboard');
    }

    public function authenticate(Request $request)
    {
        
        $credentials = $request->only('email', 'password');
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:1'
        ]);
        return $this->checkAdmin($validate , $credentials ,  $request);

    }
    
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
        
    }

    private function checkAdmin(object $validate , array $credentials , Request $request): RedirectResponse
    {
        if ($validate->passes()) {

            if (auth()->guard('admin')->attempt($credentials, $request->remember)) {
                return redirect()->route('admin.dashboard');
            }else {
                return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email', 'remember'));
            }
        } else {
            return redirect()->back()->withErrors($validate)->withInput($request->only('email', 'remember'));
        }

    }
    
    
}