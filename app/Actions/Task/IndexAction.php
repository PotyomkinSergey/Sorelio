<?php
declare(strict_types=1);

namespace App\Actions\Task;

use App\Models\Task;
use App\services\custom\CustomInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexAction
{
    public function __invoke(array $validated, CustomInterface $customInjection)
    {
        $customInjection->someFunction();
        $searchString = $validated['filter'] ?? null;
        $sortByField = 'id';
        $sortDirection = 'asc';
        if (isset($validated['sortBy'])) {
            $sortByField = ltrim($validated['sortBy'], '-');
        }
        if (isset($validated['sortBy']) && str_starts_with($validated['sortBy'], '-')) {
            $sortDirection = 'desc';
        }

        return $this->getAwarePaginator($searchString, $sortByField, $sortDirection);
    }

    /**
     * @param mixed $searchString
     * @param string $sortByField
     * @param string $sortDirection
     * @return LengthAwarePaginator
     */
    private function getAwarePaginator(
        mixed $searchString,
        string $sortByField,
        string $sortDirection
    ) {
            return Task::with('user')
                ->when($searchString, fn($q, $search) => $q
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                )
                ->orderBy($sortByField, $sortDirection)
                ->paginate(10);
    }
}
