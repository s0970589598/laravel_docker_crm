<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompaniesStoreRequest;
use App\Services\CompaniesService;
use App\Services\SystemLogService;
use View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    private $companiesService;
    private $systemLogsService;

    public function __construct()
    {
        $this->middleware('auth');

        $this->companiesService = new CompaniesService();
        $this->systemLogsService = new SystemLogService();
    }

    public function processRenderCreateForm()
    {
        return View::make('crm.companies.create')->with(['dataWithPluckOfClient' => $this->companiesService->pluckData()]);
    }

    public function processViewCompanyDetails(int $companiesId)
    {
        return View::make('crm.companies.show')->with(['company' => $this->companiesService->loadCompanie($companiesId)]);
    }
    
    public function processListOfCompanies()
    {
        return View::make('crm.companies.index')->with(
            [
                'companies' => $this->companiesService->loadCompanies(),
                'companiesPaginate' => $this->companiesService->loadPagination()
            ]
        );
    }

    public function processRenderUpdateForm(int $companiesId)
    {
        return View::make('crm.companies.edit')->with(
            [
                'company' => $this->companiesService->loadCompanie($companiesId),
                'clients' => $this->companiesService->pluckData()
            ]
        );
    }

    public function processStoreCompany(CompaniesStoreRequest $request)
    {
        if ($company = $this->companiesService->execute($request->validated(), $this->getAdminId())) {
            $this->systemLogsService->loadInsertSystemLogs('CompaniesModel has been add with id: ' . $company, $this->systemLogsService::successCode, $this->getAdminId());
            return Redirect::to('companies')->with('message_success', $this->getMessage('messages.SuccessCompaniesStore'));
        } else {
            return Redirect::back()->with('message_danger', $this->getMessage('messages.ErrorCompaniesStore'));
        }
    }

    public function processUpdateCompany(Request $request, int $companiesId)
    {
        if ($this->companiesService->update($companiesId, $request->all())) {
            return Redirect::to('companies')->with('message_success', $this->getMessage('messages.SuccessCompaniesUpdate'));
        } else {
            return Redirect::back()->with('message_success', $this->getMessage('messages.ErrorCompaniesUpdate'));
        }
    }

    public function processDeleteCompany(int $companiesId)
    {
        $dataOfCompanies = $this->companiesService->loadCompanie($companiesId);

        $countDeals = $this->companiesService->loadCountAssignedDeals($companiesId);

        if ($countDeals > 0) {
            return Redirect::back()->with('message_danger', $this->getMessage('messages.firstDeleteDeals'));
        }

        $dataOfCompanies->delete();

        $this->systemLogsService->loadInsertSystemLogs('CompaniesModel has been deleted with id: ' . $dataOfCompanies->id, $this->systemLogsService::successCode, $this->getAdminId());

        return Redirect::to('companies')->with('message_success', $this->getMessage('messages.SuccessCompaniesDelete'));
    }

    public function processSetIsActive(int $companiesId, bool $value)
    {
        if ($this->companiesService->loadSetActive($companiesId, $value)) {
            $this->systemLogsService->loadInsertSystemLogs('CompaniesModel has been enabled with id: ' . $companiesId, $this->systemLogsService::successCode, $this->getAdminId());
            return Redirect::to('companies')->with('message_success', $this->getMessage('messages.SuccessCompaniesActive'));
        } else {
            return Redirect::back()->with('message_danger', $this->getMessage('messages.ErrorCompaniesActive'));
        }
    }
}
