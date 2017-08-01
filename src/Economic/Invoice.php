<?php

namespace Ruth\Api\Economic;

use Ruth\Api\Foundation\Resource;

class Invoice extends Resource
{
    /**
     * Fetches all invoices.
     * @link https://restdocs.e-conomic.com/#get-invoices
     * @param  array  $query
     * @return mixed
     */
    public function get($query = [])
    {
        return $this->request('GET', 'invoices', $query);
    }

    /**
     * Fetches all draft invoices.
     * @link https://restdocs.e-conomic.com/#get-invoices-drafts
     * @param  array  $query
     * @return mixed
     */
    public function drafts($query = [])
    {
        return $this->request('GET', 'invoices/drafts', $query);
    }

    /**
     * Find a draft invoice.
     * @link https://restdocs.e-conomic.com/#get-invoices-drafts-draftinvoicenumber
     * @param  integer $id
     * @return object
     */
    public function findDraft($id)
    {
        return $this->request('GET', 'invoices/drafts/'.$id);
    }

    /**
     * Create a new invoice draft.
     * @link https://restdocs.e-conomic.com/#post-invoices-drafts
     * @param  array $invoice
     * @return object
     */
    public function createDraft($invoice)
    {
        return $this->request('POST', 'invoices/drafts', $invoice);
    }

    /**
     * Deletes all drafts.
     * @param  array  $query
     * @return mixed
     */
    public function deleteDrafts($query = [])
    {
        return $this->request('DELETE', 'invoices/drafts', $query);
    }

    /**
     * Fetches all booked invoices.
     * @link https://restdocs.e-conomic.com/#get-invoices-booked
     * @param  array  $query
     * @return mixed
     */
    public function booked($query = [])
    {
        return $this->request('GET', 'invoices/booked', $query);
    }

    /**
     * Fetches all total invoices.
     * @link https://restdocs.e-conomic.com/#get-invoices-totals
     * @param  array  $query
     * @return mixed
     */
    public function totals($query = [])
    {
        return $this->request('GET', 'invoices/totals', $query);
    }
}
