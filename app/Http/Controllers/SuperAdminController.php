<?php

namespace App\Http\Controllers;

// use App\Models\LogDML;
use ProtoneMedia\Splade\SpladeTable;
use App\Repositories\Interface\DivisiRepoInterface;
use App\Repositories\Interface\UnitRepoInterface;
use App\Repositories\Interface\LevelRepoInterface;
use App\Repositories\Interface\UserRepoInterface;
use App\Repositories\Interface\RoleRepoInterface;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use ProtoneMedia\Splade\Facades\Toast;
use App\Exceptions\DataException;
use App\Traits\ToastTrait;

use function App\Providers\log_dml;
use App\Contracts\NotificationService;
use App\Http\Requests\UserRequest;
use App\Contracts\LogService;

class SuperAdminController extends Controller
{
    use ToastTrait;
    private $notification, $log;
    private $divisiRepo, $userRepo, $roleRepo, $unitRepo, $levelRepo;
    public function __construct(
        DivisiRepoInterface $divisiRepo,
        UnitRepoInterface $unitRepo,
        LevelRepoInterface $levelRepo,
        UserRepoInterface $userRepo,
        RoleRepoInterface $roleRepo,
        NotificationService $notification,
        LogService $log
    )
    {
        $this->middleware('role:super-admin');

        $this->divisiRepo     = $divisiRepo;
        $this->unitRepo       = $unitRepo;
        $this->levelRepo      = $levelRepo;
        $this->userRepo       = $userRepo;
        $this->roleRepo       = $roleRepo;
        $this->notification   = $notification;
        $this->log            = $log;
    }

    public function index() {
        return view('dashboard.super-admin.index');
    }

    // USER
    public function users_index() {
        $users = $this->userRepo->getDataTable();
        return view('modules.users.index', compact('users'));
    }

    public function users_show($id) {
        $roles = $this->roleRepo->getData();
        $user  = $this->userRepo->findData($id);
        $role = null;

        // user has role
        foreach($roles as $role_d) {
            if($user->roles->contains($role_d->id)) {
                $role[] = $role_d->id;
            }
        }
        return view('modules.users.show', compact('user', 'roles', 'role'));
    }

    public function users_create() {
        return view('modules.users.create');
    }

    public function users_store(UserRequest $request) {
        $data = $request->validated();
        $user = $this->userRepo->storeData($data);
        if (!$user) { throw DataException::errorCreate(); }
        $this->log->create(null, $user);
        $this->successCreate($request->email);
        return redirect()->route('superadmin.users.index');
    }

    public function users_update($id, UserRequest $request) {
        // dd($request->all());
        $data   = $request->validate($request->rulesUpdate());
        $user   = $this->userRepo->updateData($id, $data);
        if (!$user) { throw DataException::errorUpdate(); }
        $this->successUpdate($request->email);
        return redirect()->route('superadmin.users.index');
    }

    public function users_password($id) {
        return view('modules.users.password', compact('id'));
    }

    public function users_password_update($id, UserRequest $request) {
        $data   = $request->validate($request->rulesUpdatePassword());
        $user_b = $this->userRepo->findData($id);
        $user   = $this->userRepo->updateDataPassword($id, $data);
        if (!$user) { throw DataException::errorUpdate(); }
        $this->successUpdate('Password '.$user_b->email);
        return redirect()->route('superadmin.users.index');
    }

    // FIXME USER Delete
    // buat seting request & belum dites
    public function users_delete($id) {
        $user = $this->userRepo->findData($id);
        $this->log->create(null, $user);
        $this->userRepo->deleteData($id);
        $this->successDelete($user->email);
        return redirect()->route('superadmin.users.index');
    }

    // DIVISI
    public function divisi_index() {
        $divisi = $this->divisiRepo->getDivisi();
        return view('modules.divisi.index', compact('divisi'));
    }

    public function divisi_create() {
        return view('modules.divisi.create');
    }

    // FIXME DIVISI Store
    // buat seting request & belum dites
    public function divisi_store(UserRequest $request) {
        $data = $request->validated();
        $divisi = $this->divisiRepo->storeData($data);
        if (!$divisi) { throw DataException::errorCreate(); }
        $this->log->create(null, $divisi);
        $this->successCreate($request->nama);
        return redirect()->route('superadmin.divisi.index');
    }

    // UNIT
    public function unit_index() {
        $unit = $this->unitRepo->getDataTable();

        return view('modules.unit.index', compact('unit'));
    }
    public function unit_create() {
        return view('modules.unit.create');
    }

    // FIXME UNIT Store
    // buat seting request & belum dites
    public function unit_store(UserRequest $request) {
        $data = $request->validated();
        $unit = $this->unitRepo->storeData($data);
        if (!$unit) { throw DataException::errorCreate(); }
        $this->log->create(null, $unit);
        $this->successCreate($request->nama);
        return redirect()->route('superadmin.unit.index');
    }

    //LEVEL
    public function level_index() {
        $level = $this->levelRepo->getDataTable();
        return view('modules.level.index', compact('level'));
    }

    public function level_create() {
        return view('modules.level.create');
    }

    // FIXME LEVEL Store
    // buat seting request & belum dites
    public function level_store(UserRequest $request) {
        $data = $request->validated();
        $level = $this->levelRepo->storeData($data);
        if (!$level) { throw DataException::errorCreate(); }
        $this->log->create(null, $level);
        $this->successCreate($request->nama);
        return redirect()->route('superadmin.level.index');
    }


    public function coa() {
        $roles = SpladeTable::for(Role::class)
        ->column('name')
        ->paginate(10);

        $permissions = Permission::all();

        return view('modules.coa.index', compact('roles', 'permissions'));
    }

    public function roles_index() {
        $roles = SpladeTable::for(Role::class)
                ->column('name')
                ->column('created_at')
                ->paginate(10);

        $permissions = Permission::all();

        return view('modules.roles.index', compact('roles', 'permissions'));
    }

    public function roles_create() {
        return view('modules.roles.create');
    }

    public function roles_store() {
        request()->validate([
            'name' => 'required|string|min:3|max:50',
        ]);

        try {
            $role = Role::create(['name' => request()->name]);
            $this->log->create(null, $role);

            Toast::title('Data Berhasil Ditambahkan');
            return redirect()->route('superadmin.roles.index');
        } catch (\Throwable $th) {
            Toast::warning($th, 'Terjadi Kesalahan, Mohon Ulangi');
            return redirect()->route('superadmin.roles.index');
        }

    }

    public function log_dml_index() {
        $log_dml = null ;
        // $log_dml = SpladeTable::for(LogDML::class)
        // ->column(
        //     key     : 'user.name',
        //     label   : 'user'
        // )
        // ->column('status')
        // ->column('from')
        // ->column('to')
        // ->paginate(10);

        return view('modules.log-dml.index', compact('log_dml'));
    }
}
