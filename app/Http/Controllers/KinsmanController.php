<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKinsmanRequest;
use App\Http\Requests\UpdateKinsmanRequest;
use App\Repositories\KinsmanRepository;
use Illuminate\Http\RedirectResponse;

class KinsmanController extends Controller
{
    private const PER_PAGE = 10;
    private const DEFAULT_SORT = 'updated_at';
    private const EAGER_LOADING = true;
    private const OPTIONS = [
        'perPage' => self::PER_PAGE,
        'defaultSort' => self::DEFAULT_SORT,
        'eager' => self::EAGER_LOADING,
    ];

    private KinsmanRepository $repository;

    public function __construct(KinsmanRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index()
    {
        $kinsmans = $this->repository->getAll(self::OPTIONS);

        return view('kinsmans.index', [
            'models' => $kinsmans,
            'nav' => $this->nav
        ]);
    }

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

    public function store(CreateKinsmanRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $kinsmanId = $this->repository->create($dto);

        return redirect()->route('kinsmans.show', $kinsmanId);
    }

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

    public function edit(int $id)
    {
        [$kinsman, $fathers, $mothers, $kins, $selected] = $this->repository->edit($id);

        return view('kinsmans.edit', [
            'model' => $kinsman,
            'fathers' => $fathers,
            'mothers' => $mothers,
            'kins' => $kins,
            'selected' => $selected,
            'nav' => $this->nav
        ]);
    }

    public function update(UpdateKinsmanRequest $request): RedirectResponse
    {
        $dto = $request->createDto();

        $kinsmanId = $this->repository->update($dto);

        return redirect()->route('kinsmans.show', $kinsmanId);
    }

    public function destroy($id)
    {
        //
    }
}
