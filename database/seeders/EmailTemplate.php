<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmailTemplate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'subject' => 'Invoice {invoice_no} Due On {due_date}',
                'body' =>
                    '<p>Dear {name} ( {company_name} )</p>
                       <p>Please see attached the invoice INV{invoice_no}.
                        The invoice&nbsp; INV{invoice_no} is due by {due_date}.</p>
                        <p>Please do not hesitate to get in touch if you have any
                        questions or need clarifications.</p>
                        <p>Best Regards<br>
                        {user_name}<br>
                        </p>'
            ),
            array(
                'subject' => 'Quotation For',
                'body' =>
                    '<p>Respected {company_name}.</p>
                   <p>Courteously, my name is {user_name} from
                   <span style="font-size: 1rem;">&nbsp;chiminya logistics.
                   I am writting this email in&nbsp;</span>
                   <span style="font-size: 1rem;">regarding the quotation for transport
                   services you requested. We are pleased to quote you&nbsp;</span>
                   <span style="font-size: 1rem;">our best offer. </span>
                   </p>
                   <p><span style="font-size: 1rem;">We thank you for giving us the opportunity
                   for transporting your valuable goods&nbsp;</span>
                   <span style="font-size: 1rem;">and trusting our company.
                   We assure you the best service and will be looking forward
                    to your confirmation/response.</span>
                    </p>
                    <p>Please find/see the attached quotation document.</p>
                    <p>Best Regards<br>
                    {user_name}</p>
                    <div><br></div>'
            ),

        );
        \App\Models\EmailTemplate::insert($data);
    }
}
