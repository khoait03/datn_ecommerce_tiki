<?php

namespace App\Filament\App\Resources\CategoryPostResource\Pages;

use App\Filament\App\Resources\CategoryPostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoryPost extends CreateRecord
{
    protected static string $resource = CategoryPostResource::class;
}
