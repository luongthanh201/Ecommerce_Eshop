<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberProfileRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MemberLoginRequest;
use App\Http\Requests\MemberRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("frontend.member.register");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("frontend.member.login");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
       if(Auth::check()){
        $member = Auth::user();
        $country = Country::all();

        if (!$member) {
            return redirect()->back()->withErrors(['error' => 'Không có account nào.']);
        }

        if ($member->level != 0) {
            return redirect()->back()->withErrors(['error' => 'bạn không được phép cập nhật account này.']);
        }

        return view('frontend.account.update-profile', compact('member', 'country'));
       }
    }

    public function update(MemberProfileRequest $request)
    {
        $memberID = Auth::id();
        $member = User::findOrFail($memberID);

        if (!$member) {
            return redirect()->back()->withErrors(['error' => 'Không có account nào.']);
        }

        if ($member->level != 0) {
            return redirect()->back()->withErrors(['error' => 'bạn không được phép cập nhật account này.']);
        }

        $data = $request->all();
        
        $file = $request->avatar;

        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        if ($data['phone']) {
            $member->phone = $data['phone'];
        }

        if ($data['password'] && $data['password'] == $data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $member->password;
        }

        $countryId = $request->input('country');
        // dd($countryId);
        $country = Country::find($countryId);
        
        if (!$country) {
            return back()->withErrors(['country' => 'Quốc gia không hợp lệ']);
        }
        $data['id_country'] = $countryId;

        if ($member->update($data)) {
            if (!empty($file)) {
                $file->move('upload/user', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', _('Cập nhật hồ sơ thành công'));
        } else {
            return redirect()->back()->withErrors('Cập nhật hồ sơ lỗi');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function register(MemberRegisterRequest $request)
    {
        $data = $request->all();
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        if (!isset($data['level'])) {
            $data['level'] = 0;
        }
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');       
            $fileName = $file->getClientOriginalName();
            // Lưu tên file vào cột 'image'
            $data['avatar'] = $fileName;
            // Di chuyển file hình ảnh vào thư mục lưu trữ mong muốn
            $file->move('upload/user', $fileName);
        }
        $data['password'] = bcrypt($data['password']);

        User::create($data);
        return redirect('/login_member')->with("Đăng ký thành công");
    }
    public function login(MemberLoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];
        $remember = false;
        if ($request->remember_me) {
            $remember = true;
        }
        if (Auth::attempt($login, $remember)) {
            return redirect('/product/index')->with('login thành công');
        } else {
            return redirect()->back()->with("Email hoặc password không đúng!");
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login_member');
    }

}
