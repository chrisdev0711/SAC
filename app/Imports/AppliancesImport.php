<?php

namespace App\Imports;

use App\Models\Appliance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

use \PhpOffice\PhpSpreadsheet\Shared\Date as DateConvert;
Use DateTime;

class AppliancesImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $vat_rate = env('VAT_RATE')/100;
        $cost_exVat = $row['purchase_amount_exc_vat'];
        if(gettype($cost_exVat) == 'string')
        {
            $cost_exVat = (double)$cost_exVat;
        }

        if(gettype($row['purchase_date']) != 'string')
            $purchase_date = DateConvert::excelToDateTimeObject($row['purchase_date']);
        else
            $purchase_date = $row['purchase_date'];

        $cost_incVat = (1+ $vat_rate) * $cost_exVat;

        return new Appliance([
            'SACNo' => $row['sac_serial_no'],
            'ModelNumber' => $row['model_number'],
            'Description' => $row['description'],
            'Supplier' => $row['supplier'],
            'purchase_date' => $purchase_date,
            'CostExVat' => $cost_exVat,
            'VAT' => env('VAT_RATE'),
            'CostIncVAT' => $cost_incVat,
            'PONumber' => $row['purchase_invoice_number'],
            'OtherRef' => $row['other_ref'],
            'SerialNum' => '00000000',
        ]);
    }

    public function rules(): array {
        return [
            '*.sac_serial_no' => ['required','unique:appliances,SACNo'],
            '*.model_number' => ['required'],
            '*.description' => ['required', 'max:255', 'string'],
            '*.supplier' => ['required', 'max:255', 'string'],
            '*.purchase_amount_exc_vat' => ['required'],
            '*.purchase_invoice_number' => ['required', 'max:255'],
            '*.other_ref' => ['required', 'max:255', 'string'],
        ];
    }
}
