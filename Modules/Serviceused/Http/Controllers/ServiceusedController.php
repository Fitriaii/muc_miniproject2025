<?php

namespace Modules\Serviceused\Http\Controllers;

use App\Models\marketing\ProposalModel;
use App\Models\marketing\ServiceusedModel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ServiceusedController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $services = ServiceusedModel::with(['proposal', 'timesheets'])->get();
        $proposalList = ProposalModel::all();
        return view('serviceused::index', compact('services', 'proposalList'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('serviceused::create', compact('proposalList', 'services'));
    }


    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'proposal_id' => 'required|exists:mysql_marketing.proposal,id',
            'service_name' => 'required|string|max:255',
            'status' => 'required|string|in:pending, ongoing, done',
        ]);

        try {
            $serviceused = new ServiceusedModel();
            $serviceused->proposal_id = $request->proposal_id;
            $serviceused->service_name = $request->service_name;
            $serviceused->status = $request->status;
            $serviceused->save();

            return redirect()->route('serviceused.index')->with([
                'status' => 'success',
                'message' => 'Service used created successfully.',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([
                'status' => 'error',
                'message' => 'An error occurred while creating the service used: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('serviceused::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('serviceused::index');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'proposal_id' => 'required|exists:mysql_marketing.proposal,id',
            'service_name' => 'required|string|max:255',
            'status' => 'required|string|in:pending,ongoing,done',
        ]);

        try {
            $serviceused = ServiceusedModel::findOrFail($id);
            $serviceused->proposal_id = $request->proposal_id;
            $serviceused->service_name = $request->service_name;
            $serviceused->status = $request->status;
            $serviceused->save();

            return redirect()->route('serviceused.index')->with([
                'status' => 'success',
                'message' => 'Service used updated successfully.',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors([
                'status' => 'error',
                'message' => 'An error occurred while updating the service used: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $serviceused = ServiceusedModel::findOrFail($id);
            $serviceused->delete();

            return redirect()->route('serviceused.index')->with([
                'status' => 'success',
                'message' => 'Service used deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return redirect()->route('serviceused.index')->withErrors([
                'status' => 'error',
                'message' => 'An error occurred while deleting the service used: ' . $e->getMessage(),
            ]);
        }
    }
}
