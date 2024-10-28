<?php

namespace App\Filament\Resources\Shield\RoleResource\Pages;

use App\Filament\Resources\Shield\RoleResource;
use App\Models\Role;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;


class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->visible(fn() => auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin')),
        ];
    }
    protected function getTableQuery(): Builder
    {
        // Lấy vai trò của người dùng hiện tại
        $user = auth()->user();
        $roles = $user->roles;

        // Kiểm tra xem người dùng có vai trò "admin" hoặc "super_admin" không
        $isAdminOrSuperAdmin = $roles->contains(function ($role) {
            return $role->name === 'admin' || $role->name === 'super_admin';
        });

        // Kiểm tra xem người dùng có vai trò "admin" không
        $isAdmin = $roles->contains(function ($role) {
            return $role->name === 'admin';
        });

        // Kiểm tra xem người dùng có vai trò "super_admin" không
        $isSuperAdmin = $roles->contains(function ($role) {
            return $role->name === 'super_admin';
        });

        // Lọc dữ liệu để ẩn các hàng nếu người dùng không có vai trò "admin" hoặc "super_admin"
        return Role::query()
            ->when(!$isAdminOrSuperAdmin, function ($query) {
                $query->whereNotIn('name', ['super_admin', 'admin']);
            })
            // Truy vấn bảng Role, lọc dữ liệu để ẩn hàng có tên "super_admin" nếu người dùng là "admin"
            ->when($isAdmin && !$isSuperAdmin, function ($query) {
                $query->where('name', '!=', 'super_admin');
            });
    }



}
