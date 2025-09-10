<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Interfaces\AdminRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class AdminController extends Controller
{
    private AdminRepositoryInterface $adminRepository;

    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = $this->adminRepository->getAllAdmins();

        return view('pages.admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        $data = $request->validated();

        $this->adminRepository->createAdmin($data);

        Swal::toast('Data Admin Berhasil Ditambahkan', 'success')->timerProgressBar();

        return redirect()->route('admin.admins.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fungsi ini bisa Anda kembangkan jika perlu halaman detail admin
        $admin = $this->adminRepository->getAdminById($id);
        return view('pages.admin.admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = $this->adminRepository->getAdminById($id);

        return view('pages.admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, string $id)
    {
        $data = $request->validated();

        $this->adminRepository->updateAdmin($data, $id);

        Swal::toast('Data Admin Berhasil Diupdate', 'success')->timerProgressBar();

        return redirect()->route('admin.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Tambahkan pengecekan agar admin tidak bisa menghapus dirinya sendiri
        if (auth()->user()->id == $id) {
            Swal::toast('Anda tidak dapat menghapus akun Anda sendiri.', 'error')->timerProgressBar();
            return back();
        }

        $this->adminRepository->deleteAdmin($id);

        Swal::toast('Data Admin Berhasil Dihapus', 'success')->timerProgressBar();

        return redirect()->route('admin.admins.index');
    }
}
