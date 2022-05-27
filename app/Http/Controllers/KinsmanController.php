<?php

namespace App\Http\Controllers;

use App\Http\Requests\KinsmanRequest;
use App\Repositories\KinsmanRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

        return view('kinsmans.edit', [
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
    public function store(KinsmanRequest $request): RedirectResponse
    {
        $dto = $request->all();

        $kinsmanId = $this->repository->save($dto);

        return redirect()->route('kinsmans.show', $kinsmanId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
