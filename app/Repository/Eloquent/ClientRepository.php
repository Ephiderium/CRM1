<?php

namespace App\Repository\Eloquent;

use App\Models\Client;
use App\Models\Comment;
use App\Repository\Eloquent\Interfaces\ClientRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Pipelines\Filters\Client\CompanyFilter;
use App\Pipelines\Filters\Client\EmailFilter;
use App\Pipelines\Filters\Client\ManagerFilter;
use App\Pipelines\Filters\Client\NameFilter;
use App\Pipelines\Filters\Client\PhoneFilter;
use App\Pipelines\Filters\Client\SourceFilter;
use App\Pipelines\Filters\Client\StatusFilter;
use App\Pipelines\ClientPipeline;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ClientRepository implements ClientRepositoryInterface
{
    public function index($request): LengthAwarePaginator
    {
        $pipeline = new ClientPipeline([
            new CompanyFilter($request),
            new EmailFilter($request),
            new ManagerFilter($request),
            new NameFilter($request),
            new PhoneFilter($request),
            new SourceFilter($request),
            new StatusFilter($request),
        ]);

        $clients = $pipeline->apply(Client::query())->paginate(20);

        return $clients;
    }

    public function create(array $data): Client
    {
        return Client::create($data);
    }

    public function findById(int $id): ?Client
    {
        return Client::find($id);
    }

    public function findByEmail(string $email): Client
    {
        return Client::where('email', $email)->first();
    }

    public function update(int $id, array $data): Client
    {
        $user = Client::find($id);
        $user->update($data);
        $user->refresh();

        return $user;
    }

    public function delete(int $id): bool
    {
        $user = Client::find($id);
        return $user->delete();
    }

    public function forceDelete(int $id): bool
    {
        $user = Client::find($id);
        return $user->forceDelete();
    }

    public function findByFilters(\Closure $callback)
    {
        $builder = Client::query();
        $callback($builder);

        return $builder->get();
    }

    public function createComment(int $id, array $data): ?Comment
    {
        $model = Client::find($id);
        $model->comments()->create();

        return Comment::where('body', $data['body'])
            ->where('user_id', $data['user_id'])
            ->first();
    }
}
