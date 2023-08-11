<?php

namespace Modules\Infrastructure\app\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Infrastructure\app\Http\Requests\StoreInfrastructureRequest;
use Modules\Infrastructure\app\Http\Requests\UpdateInfrastructureRequest;
use Modules\Infrastructure\app\Models\Infrastructure;
use Modules\Infrastructure\app\Repositories\InfrastructureRepository;
use Modules\Notivication\app\Models\Notivication;
use Modules\Revision\app\Models\Revision;

class InfrastructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index(
        InfrastructureRepository $infrastructureRepository
    ) {
        $infrastructures = $infrastructureRepository->getAll();

        return view('infrastructure::admin.index', compact('infrastructures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        $users = User::all();

        return view('infrastructure::admin.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Renderable
     */
    public function store(
        StoreInfrastructureRequest $request,
        InfrastructureRepository $infrastructureRepository
    ) {
        return $infrastructureRepository->store($request)
            ? to_route('infrastructure.index')->with('success', 'Infrastructure has been created successfully!')
            : to_route('infrastructure.index')->with('failed', 'Infrastructure was not created successfully!');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function show(Infrastructure $infrastructure)
    {
        $infrastructure->loadMissing('revisions');

        return view('infrastructure::show', compact('infrastructure'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit(Infrastructure $infrastructure)
    {
        $users = User::all();

        return view('infrastructure::admin.edit', compact('infrastructure', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Renderable
     */
    public function update(
        UpdateInfrastructureRequest $request,
        InfrastructureRepository $infrastructureRepository,
        Infrastructure $infrastructure
    ) {
        return $infrastructureRepository->update($request, $infrastructure)
            ? to_route('infrastructure.index')->with('success', 'Infrastructure has been updated successfully!')
            : to_route('infrastructure.index')->with('failed', 'Infrastructure was not updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function destroy(
        InfrastructureRepository $infrastructureRepository,
        Infrastructure $infrastructure
    ) {
        return $infrastructureRepository->destroy($infrastructure)
            ? to_route('infrastructure.index')->with('success', 'Infrastructure has been deleted successfully!')
            : to_route('infrastructure.index')->with('failed', 'Infrastructure was not deleted successfully!');
    }

    public function revisi_create(Request $request, Infrastructure $infrastructure)
    {
        return view('infrastructure::admin.revisi', compact('infrastructure'));
    }

    public function revisi_store(Request $request, Infrastructure $infrastructure)
    {
        $revisi = Revision::create(array_merge($request->only(['name', 'revisi']), ['infrastructure_id' => $infrastructure->id]));

        return $revisi && Notivication::create([
            'model' => 'Revisi',
            'target' => null,
            'route' => route('infrastructure.show', $infrastructure->id),
            'user_id' => auth()->user()->id,
        ])
            ? to_route('infrastructure.index')->with('success', 'Revisi has been created successfully!')
            : back()->with('failed', 'Revisi was not created successfully!');
    }
}
