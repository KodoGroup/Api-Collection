<?php

namespace Kodo\Economic;

use Kodo\Foundation\Resource;

class Invoices extends Resource
{
	public function drafts($query = [])
	{
		return $this->request('GET', 'invoices/drafts', $query);
	}

	public function booked($query = [])
	{
		return $this->request('GET', 'invoices/booked', $query);
	}

	public function paid($query = [])
	{
		return $this->request('GET', 'invoices/paid', $query);
	}

	public function unpaid($query = [])
	{
		return $this->request('GET', 'invoices/unpaid', $query);
	}

	public function overdue($query = [])
	{
		return $this->request('GET', 'invoices/overdue', $query);
	}

	public function notdue($query = [])
	{
		return $this->request('GET', 'invoices/not-due', $query);
	}

	public function totals($query = [])
	{
		return $this->request('GET', 'invoices/totals', $query);
	}

	public function sent($query = [])
	{
		return $this->request('GET', 'invoices/sent', $query);
	}

	public function createDraft($invoice)
	{
		return $this->request('POST', 'invoices/drafts', $invoice);
	}
}