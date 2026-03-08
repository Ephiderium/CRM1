<?php

namespace App\Repository\Eloquent;

use App\Dto\ClientDto;
use App\Dto\CommentDto;
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
    public function index($dto): array
    {
        $pipeline = new ClientPipeline([
            new CompanyFilter($dto),
            new EmailFilter($dto),
            new ManagerFilter($dto),
            new NameFilter($dto),
            new PhoneFilter($dto),
            new SourceFilter($dto),
            new StatusFilter($dto),
        ]);

        $clients = $pipeline->apply(Client::query())
            ->get()
            ->map(fn (Client $client) => ClientDto::fromModel($client))
            ->all();

        return $clients;
    }

    public function create(array $data): ClientDto
    {
        return ClientDto::fromModel(Client::create($data));
    }

    public function findById(int $id): ?ClientDto
    {
        return ClientDto::fromModel(Client::find($id));
    }

    public function findByEmail(string $email): ClientDto
    {
        return ClientDto::fromModel(Client::where('email', $email)->first());
    }

    public function update(int $id, array $data): ClientDto
    {
        $user = Client::find($id);
        $user->update($data);
        $user->refresh();

        return ClientDto::fromModel($user);
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

        return $builder
            ->get()
            ->mapInto(ClientDto::class)
            ->all();
    }

    public function createComment(int $id, array $data): ?CommentDto
    {
        $model = Client::find($id);
        $model->comments()->create($data);

        return CommentDto::fromModel(Comment::where('body', $data['body'])
            ->where('user_id', $data['user_id'])
            ->first());
    }
}
