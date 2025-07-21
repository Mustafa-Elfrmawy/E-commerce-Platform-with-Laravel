<?php

namespace App\Http\Controllers\user;

use App\Models\Order;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Jenssegers\Agent\Agent;
/* 

$agent = new Agent();

$deviceType = $agent->device(); // مثل iPhone / SM-G998B / etc
$platform   = $agent->platform(); // مثل Android / Windows / iOS
$platformVersion = $agent->version($platform);

$browser    = $agent->browser(); // مثل Chrome / Safari
$browserVersion = $agent->version($browser);

$isMobile   = $agent->isMobile(); // true or false
$isDesktop  = $agent->isDesktop();
$isTablet   = $agent->isTablet();
 */
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Casts\Json;

class UserAuthenticateController extends Controller
{
    //


    public function showProfile(): View|\Illuminate\Http\RedirectResponse
    {
        if (!Auth::guard('user')->check()) {
            return redirect()->route('user.login')->with('error', 'You must be logged in to view your profile.');
        }
        $user = Auth::guard('user')->user();
        return view('front.user.profile', compact('user'));
    }

    public function index(): View
    {
        return view('front.user.login');
    }

    public function register(): View
    {
        return view('front.user.register');
    }
    public function proccessRegister(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|numeric|regex:/^[0-9]{4,15}$/|unique:users,phone',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $user = new \App\Models\User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('user.login')->with('successRegister', "Thank you Mr.$user->name .");
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

    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if (!Auth::guard('user')->check()) {
            return response()->json([
                'status' => true,
                'message' => 'Logout successful'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Logout error'
        ]);
    }

    private function checkAdmin(object $validate, array $credentials, Request $request): RedirectResponse
    {
        if ($validate->passes()) {

            if (auth()->guard('user')->attempt($credentials, $request->remember)) {
                return redirect()->route('front.home');
            } else {
                return redirect()->back()->withErrors(['email' => 'Invalid credentials or password incorrect'])->withInput($request->only('email', 'remember'));
            }
        } else {
            return redirect()->back()->withErrors($validate)->withInput($request->only('email', 'remember'));
        }
    }


    public function updateInformation(Request $request): RedirectResponse
    {
        $user = Auth::guard('user')->user();
        // dd($request->all(), $user);
        $no_changes =
            $request->name == $user->name &&
            $request->email == $user->email &&
            $request->phone == $user->phone &&
            $request->address == $user->address;

        if ($no_changes) {
            return redirect()->back()->with('message', 'No changes made to your profile.');
        }

        $validate = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email,' . Auth::guard('user')->id(),
            'phone' => 'nullable|numeric|regex:/^[0-9]{4,15}$/|unique:users,phone,' . Auth::guard('user')->id(),
            'address' => 'nullable|min:3|max:500',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate->errors())
                ->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return redirect()->back()->with('success', 'changes successfully ');
    }
    public function changePasswordCreate() {

        return view('front.user.changepassword');
    }
    public function changePasswordStore(Request $request): RedirectResponse
    {
        $user = Auth::guard('user')->user();

        $validate = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->back()->with('successChangePassword', 'Password changed successfully.');
    }
}
