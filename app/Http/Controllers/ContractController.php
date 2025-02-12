<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContractRequest;
use App\Repositories\ContractRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    private $contractRepository;

    public function __construct(ContractRepository $contractRepo)
    {
        $this->contractRepository = $contractRepo;
    }

    public function index(Request $request): \Illuminate\View\View
    {
        return view('contracts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\View\View
    {
        $data = $this->contractRepository->getData();
        $clients = $data['clients'];


        return view('contracts.create', compact('clients'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateContractRequest $request): RedirectResponse
    {
        $input = $request->all();
        try {
            $this->contractRepository->store($input);
            Flash::success(__('messages.flash.contract_created_successfully'));
        } catch (Exception $exception) {
            Flash::error($exception->getMessage());

            return redirect()->route('clients.create')->withInput();
        }

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
