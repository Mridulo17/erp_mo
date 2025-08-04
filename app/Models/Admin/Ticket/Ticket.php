<?php

namespace App\Models\Admin\Ticket;

use App\Models\Admin\Process\AirlineOffice;
use App\Models\Supper_Admin\Location\Country;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable =
        [
            'ticket_name',
            'issue_date',
            'source',
            'country_id',
            'ticket_type',
            'candidate_type_id',
            'airline_office_id',
            'other_office_id',
            'is_pre_purchase',
            'pnr_number',
            'attachment',
            'flight_date',
            'flight_time',
            'flight_number',
            'purchase_payment_type',
            'purchase_amount',
            'sell_amount_total',
            'total_candidate',
            'per_ticket_amount',
            'vat_or_tax_amount',
            'partial_sell_amount',
            'agent_commission',
            'is_refundable',
            'is_make_flight_complete',
            'payment_type',
            'payment_method',
            'ticket_price_payment_method',
            'transaction_note',
            'note'
        ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function airlineOffice()
    {
        return $this->belongsTo(AirlineOffice::class);
    }
}
