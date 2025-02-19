<?php

namespace App\Http\Controllers;



use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Wine\WineRepositoryInterface;
use App\Http\Requests\WineRequest;
use App\Models\Wine;

class WineController extends Controller
{
    public function __construct(private readonly WineRepositoryInterface $repository)
    {
    }

    public function index(): View
    {
        return view('wine.index', [
            'wines' => $this->repository->paginate(
                relationships: ['category']
            )
        ]);
    }

    public function create(): View
    {
        return view('wine.create', [
            'wine' => new Wine(),
            'action' => route('wines.store'),
            'method' => 'POST',
            'submit' => 'Create',
        ]);
    }

    public function store(WineRequest $request): RedirectResponse
    {
        $this->repository->create($request->validated());
        session()->flash('success', 'Vino creado correctamente');
        return redirect()->route('wines.index');
    }

    public function edit(Wine $wine): View
    {
        return view('wine.edit', [
            'wine' => $wine,
            'action' => route('wines.update', $wine),
            'method' => 'PUT',
            'submit' => 'Update',
        ]);
    }

    public function update(WineRequest $request, Wine $wine): RedirectResponse
    {
        $this->repository->update($request->validated(), $wine);
        session()->flash('success', 'Vino actualizado correctamente');
        return redirect()->route('wines.index');
    }

    public function destroy(Wine $wine): RedirectResponse
    {
        try {
            $this->repository->delete($wine);
            session()->flash('success', 'Vino eliminado correctamente');
        } catch (\Exception $e) {
            session()->flash('error', 'No se puede eliminar el vino');
        }

        return redirect()->route('wines.index');
    }
}
