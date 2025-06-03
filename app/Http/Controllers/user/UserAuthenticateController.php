<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Redirect;

use function Laravel\Prompts\error;

class UserAuthenticateController extends Controller
{
    //


    public function showProfile(): View|\Illuminate\Http\RedirectResponse
    {
        if (!Auth::guard('user')->check()) {
            return redirect()->route('user.login')->with('error', 'You must be logged in to view your profile.');
        }
        // $arr_formats_product = [];
        // $arr_formats_quantity = [];
        // $orders = Order::all();  
        // foreach ($orders as $order) {
        //     foreach (explode(',', $order->product_id) as $arr_format) :
        //         $pos = strpos($arr_format, 'x');
        //         $arr_formats_product[] = substr($arr_format, 0, $pos);
        //         $arr_formats_quantity[] = substr($arr_format,  $pos + 1);
        //     endforeach;
        // }
        // echo "<pre>";
        // print_r($arr_formats_product);
        // print_r($arr_formats_quantity);
        // dd($orders);
        // Get the authenticated user
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
        return redirect()->route('user.login')->with('success', 'Registration successful. Please login.');
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
}
