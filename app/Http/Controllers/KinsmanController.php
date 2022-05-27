<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKinsmanRequest;
use App\Http\Requests\UpdateKinsmanRequest;
use App\Repositories\KinsmanRepository;
use Illuminate\Http\RedirectResponse;

class KinsmanController extends Controller
{
    private KinsmanRepository $repository;

    public function __construct(KinsmanRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $kinsmans = $this->repository->getAll(12);

        return view('kinsmans.index', [
            'models' => $kinsmans,
            'nav' => $this->nav
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        [$kinsman, $fathers, $mothers, $kins] = $this->repository->add();

        return view('kinsmans.create', [
            'model' => $kinsman,
            'fathers' => $fathers,
            'mothers' => $mothers,
            'kins' => $kins,
            'nav' => $this->nav
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CreateKinsmanRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $kinsmanId = $this->repository->create($dto);

        return redirect()->route('kinsmans.show', $kinsmanId);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(int $id)
    {
        $kinsman = $this->repository->getOne($id);
        $children = $this->repository->getChildren($id);

        return view('kinsmans.show', [
            'model' => $kinsman,
            'children' => $children,
            'nav' =>$this->nav
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        [$kinsman, $fathers, $mothers, $kins] = $this->repository->edit($id);

        return view('kinsmans.edit', [
            'model' => $kinsman,
            'fathers' => $fathers,
            'mothers' => $mothers,
            'kins' => $kins,
            'nav' => $this->nav
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateKinsmanRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateKinsmanRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $kinsmanId = $this->repository->update($dto);

        return redirect()->route('kinsmans.show', $kinsmanId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
