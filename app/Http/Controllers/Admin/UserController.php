<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repositories\Interface\UserRepoInterface;
use App\Repositories\Interface\RoleRepoInterface;
use App\Exceptions\DataException;
use App\Traits\ToastTrait;

use App\Contracts\NotificationService;
use App\Http\Requests\UserRequest;
use App\Contracts\LogService;
use App\Models\User;

class UserController extends Controller
{
    use ToastTrait;
    private $notification, $log;
    private $userRepo, $roleRepo;
    public function __construct(
        UserRepoInterface $userRepo,
        RoleRepoInterface $roleRepo,
        NotificationService $notification,
        LogService $log
    )
    {
        // $this->middleware('role:admin-tahsin|admin-rtq|admin-tla|admin-rq|admin-tahla');

        $this->userRepo       = $userRepo;
        $this->roleRepo       = $roleRepo;
        $this->notification   = $notification;
        $this->log            = $log;
    }

    public function index($unit) {
        // $users = $this->userRepo->getDataTable($unit);

        $users = User::where(function($query) {
                        $query->where('name', 'LIKE', '%' . request('search') . '%')
                            ->orWhere('email', 'LIKE', '%' . request('search') . '%');
                    })
                    ->orderBy('name')
                    ->paginate(10);
        // dd($users);


        return view('dashboard.admin.user.index', compact('users', 'unit'));
    }


    public function show($id, $unit) {
        $roles = $this->roleRepo->getData();
        $user  = User::find($id);

        dd($unit);
        // user has role
        // if ($user) {
        //     foreach($roles as $role_d) {
        //         if($user->roles->contains($role_d->id)) {
        //             $role[] = $role_d->id;
        //         }
        //     }
        // } else {
        //     $role[] = [];
        // }
        $role = $user->roles->pluck('id')->toArray();
        return view('dashboard.admin.user.show', compact('user', 'roles', 'role'));
    }

    public function create() {
        return view('dashboard.admin.user.create');
    }

    public function store(UserRequest $request) {
        $data = $request->validated();
        $user = $this->userRepo->storeData($data);
        if (!$user) { throw DataException::errorCreate(); }
        $this->log->create(null, $user);
        $this->successCreate($request->email);
        return redirect()->route('admin.user.index');
    }

    public function update($id, UserRequest $request) {
        // dd($request->all());
        $data   = $request->validate($request->rulesUpdate());
        $user   = $this->userRepo->updateData($id, $data);
        if (!$user) { throw DataException::errorUpdate(); }
        $this->successUpdate($request->email);
        return redirect()->route('admin.user.index');
    }

    public function password($id) {
        return view('dashboard.admin.user.password', compact('id'));
    }

    public function password_update($id, UserRequest $request) {
        $data   = $request->validate($request->rulesUpdatePassword());
        $user_b = $this->userRepo->findData($id);
        $user   = $this->userRepo->updateDataPassword($id, $data);
        if (!$user) { throw DataException::errorUpdate(); }
        $this->successUpdate('Password '.$user_b->email);
        return redirect()->route('admin.user.index');
    }

    public function destroy($unit, $id)
    {
        // Logika untuk menghapus data berdasarkan ID
    }
}
