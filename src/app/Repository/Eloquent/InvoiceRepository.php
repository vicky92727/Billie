<?php

namespace App\Repository\Eloquent;

use App\Models\Invoice;
use App\Repository\InvoiceRepositoryInterface;

class InvoiceRepository extends BaseRepository implements InvoiceRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Invoice $model)
    {
        $this->model = $model;
       
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {

        $userData = $request->only([
            'title', 
            'detail', 
            'company_id', 
            'status', 
            'invoice_to',
            'invoice_number',
            'invoice_date',
            'invoice_due_date',
            'invoice_total'
        ]);

        $postData['title'] = ucwords($userData['title']);
        $postData['detail'] = $userData['detail'];
        $postData['company_id'] = $userData['company_id'];
        $postData['status'] = $userData['status'];
        $postData['invoice_to'] = $userData['invoice_to'];
        $postData['invoice_number'] = $userData['invoice_number'];
        $postData['invoice_date'] = $userData['invoice_date'];
        $postData['invoice_due_date'] = $userData['invoice_due_date'];
        $postData['invoice_total'] = $userData['invoice_total'];
        $invoice = $this->create($postData);
        return $invoice;
    }

    public function getOpenInvoices($id)
    {
        $openInvoices = $this->model->where(['status' => 1, 'company_id' => $id])->get();
        return $openInvoices->count();
    }

    /**
     * @param $request
     * @param $user
     * @return mixed
     */
    public function updateRecord($request, $id)
    {
        $data = $request->all();

        if($request->has('status')) {
            $data['status'] = $data['status'];
        }
        $invoice = $this->update($id, $data);
        if($invoice){
            $invoice = $this->findById($id);
        }
        return $invoice;
    }

    /**
     * @param $id
     * @param $user
     * @return mixed
     */
    public function getInvoiceByNumber($invoice_number)
    {
       $rec =  $this->model->where('invoice_number', $invoice_number)->first();
       if($rec!=null){
            return $rec->id;
       } else {
        return false;
       }
    }
}