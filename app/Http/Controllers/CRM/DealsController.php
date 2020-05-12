<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\DealsStoreRequest;
use App\Http\Requests\DealsTermsStoreRequest;
use App\Services\DealsService;
use App\Services\SystemLogService;
use View;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Redirect;

class DealsController extends Controller
{
    private $dealsService;
    private $systemLogsService;

    public function __construct()
    {
        $this->middleware('auth');

        $this->dealsService = new DealsService();
        $this->systemLogsService = new SystemLogService();
    }

    public function processRenderCreateForm()
    {
        return View::make('crm.deals.create')->with(['dataOfDeals' => $this->dealsService->pluckDeals()]);
    }

    public function processShowDealsDetails(int $dealId)
    {
        return View::make('crm.deals.show')->with(['deal' => $this->dealsService->loadDeal($dealId), 'dealsTerms' => $this->dealsService->loadDealsTerms($dealId)]);
    }

    public function processListOfDeals()
    {
        return View::make('crm.deals.index')->with(
            [
                'deals' => $this->dealsService->loadDeals(),
                'dealsPaginate' => $this->dealsService->loadPaginate()
            ]
        );
    }

    public function processRenderUpdateForm(int $dealId)
    {
        return View::make('crm.deals.edit')->with(
            [
                'deal' => $this->dealsService->loadDeal($dealId),
                'companies' => $this->dealsService->pluckDeals()
            ]
        );
    }

    public function processStoreDeal(DealsStoreRequest $request)
    {
        if ($dealId = $this->dealsService->execute($request->validated(), $this->getAdminId())) {
            $this->systemLogsService->loadInsertSystemLogs('Deal has been add with id: ' . $dealId, $this->systemLogsService::successCode, $this->getAdminId());
            return Redirect::to('deals')->with('message_success', $this->getMessage('messages.SuccessDealsStore'));
        } else {
            return Redirect::back()->with('message_danger', $this->getMessage('messages.ErrorDealsStore'));
        }
    }

    public function processUpdateDeal(Request $request, int $dealId)
    {
        if ($this->dealsService->update($dealId, $request->all())) {
            return Redirect::to('deals')->with('message_success', $this->getMessage('messages.SuccessDealsUpdate'));
        } else {
            return Redirect::back()->with('message_danger', $this->getMessage('messages.ErrorDealsUpdate'));
        }
    }

    public function processDeleteDeal(int $dealId)
    {
        $dataOfDeals = $this->dealsService->loadDeal($dealId);
        $dataOfDeals->delete();

        $this->systemLogsService->loadInsertSystemLogs('Deals has been deleted with id: ' . $dataOfDeals->id, $this->systemLogsService::successCode, $this->getAdminId());

        return Redirect::to('deals')->with('message_success', $this->getMessage('messages.SuccessDealsDelete'));
    }

    public function processSetIsActive(int $dealId, bool $value)
    {
        if ($this->dealsService->loadSetActive($dealId, $value)) {
            $this->systemLogsService->loadInsertSystemLogs('Deals has been enabled with id: ' . $dealId, $this->systemLogsService::successCode, $this->getAdminId());
            return Redirect::to('deals')->with('message_success', $this->getMessage('messages.SuccessDealsActive'));
        } else {
            return Redirect::back()->with('message_danger', $this->getMessage('messages.ErrorDealsActive'));
        }
    }

    public function processStoreDealTerms(Request $request)
    {
        $validatedData = $request->all();

        if ($this->dealsService->loadStoreDealTerms($validatedData)) {
            $this->systemLogsService->loadInsertSystemLogs('Deals terms has been enabled with id: ' . $validatedData['dealId'], $this->systemLogsService::successCode, $this->getAdminId());
            return Redirect::back()->with('message_success', $this->getMessage('messages.SuccessDealsActive'));
        } else {
            return Redirect::back()->with('message_danger', $this->getMessage('messages.ErrorDealsActive'));
        }
    }

    public function processGenerateDealTermsInPDF(Request $request)
    {
        $termId = $request->get('termId');

        return $this->dealsService->loadGenerateDealTermsInPDF($termId);
    }

    public function processDeleteDealTerm(Request $request)
    {
        $termId = $request->get('termId');

        $this->dealsService->loadDeleteTerm($termId);

        $this->systemLogsService->loadInsertSystemLogs('Deal terms has been deleted with id: ' . $termId, $this->systemLogsService::successCode, $this->getAdminId());

        return Redirect::back()->with('message_success', $this->getMessage('messages.SuccessDealsTermDelete'));
    }
}
