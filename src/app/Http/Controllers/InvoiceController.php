<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;
use App\Repository\InvoiceRepositoryInterface;
use App\Http\Resources\InvoiceResource;
use App\Repository\Eloquent\CompanyRepository;
class InvoiceController extends Controller
{

    private $invoiceRepository;
    
    protected $_companyrepo;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository, CompanyRepository $_companyrepo)
    {
        $this->invoiceRepository = $invoiceRepository;
         $this->_companyrepo = $_companyrepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        $debtor_limit = $this->_companyrepo->getDebtorLimit($request->company_id);
        $open_invoices = $this->invoiceRepository->getOpenInvoices($request->company_id);
        if($open_invoices < $debtor_limit) {
            $invoice = $this->invoiceRepository->saveRecord($request);
            return new InvoiceResource($invoice);
        } else {
            return response()->json(['Error' => 'Debtor Limit has been exceeded']);
        }
        
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $invoice_number)
    {
        $id = $this->invoiceRepository->getInvoiceByNumber($invoice_number);
        if($id) {
            $invoice = $this->invoiceRepository->updateRecord($request, $id);
            return new InvoiceResource($invoice);
        } else {
            return response()->json(['Error' => 'No Invoice Found']);
        }
        
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
