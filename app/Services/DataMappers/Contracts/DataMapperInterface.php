<?php declare(strict_types=1);

namespace App\Services\DataMappers\Contracts;

use App\Entities\TransactionEntity;
use Illuminate\Http\Request;

interface DataMapperInterface
{
    public function makeFromRequest(Request $request): TransactionEntity;
}
