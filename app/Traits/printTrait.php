<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Payment;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

trait printTrait
{

    // imprimir recibo de la venta
    public function payTicket(Payment $payment)
    {
        $printerName = "80mm";
        $connector = new WindowsPrintConnector($printerName);
        $printer = new Printer($connector);

        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $logo = EscposImage::load("logo.png");
        $printer->bitImage($logo);
        $printer->setTextSize(3, 3);
        $printer->text("POSMOBILE\n");
        $printer->selectPrintMode();
        $printer->text("-Recibo de Pago-\n");
        $printer->feed();

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text("FOLIO: " . str_pad($payment->id, 6, "0", STR_PAD_LEFT) . "\n");
        $printer->text("FECHA: " . Carbon::parse($payment->created_at)->format('d/m/Y h:m') . "\n");
        $printer->text("MONTO: $" . number_format($payment->amount, 2) . "\n");
        $debe = number_format($payment->sale->total - $payment->sale->pays->sum('amount'), 2);
        $printer->text("ADEUDO: $" . $debe . "\n");
        $printer->text("CLIENTE: " . $payment->sale->customer->user->name . "\n");
        $printer->feed(2);

        /* Footer */
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->selectPrintMode();
        $printer->text("luisfax.com\n");
        $printer->feed(3);

        $printer->cut();
        $printer->close();
    }


    public function saleTicket(Sale $sale)
    {
        $printerName = '80mm';
        $connector = new WindowsPrintConnector($printerName);
        $printer = new Printer($connector);
        $printer->setJustification(Printer::JUSTIFY_CENTER);

        // logo
        $logo = EscposImage::load("logo.png");
        $printer->bitImage($logo);

        $printer->setTextSize(3, 3);
        $printer->text("POSMOBILE\n");
        $printer->selectPrintMode();
        $printer->text("-Ticket de Venta-\n");
        $printer->text("Av. Periferico Nte, #991\n");
        $printer->text("Col. Centro, Morelia, Mich.\n");
        $printer->feed();

        $printer->setJustification(Printer::JUSTIFY_LEFT);
        $printer->text("FOLIO: T" . str_pad($sale->id, 6, "0", STR_PAD_LEFT) . "\n"); // T0000001
        $printer->text("FECHA: " . Carbon::parse($sale->created_at)->format('d/m/Y h:i') . "\n");
        $printer->text("ESTATUS: " . $sale->status . "\n");
        $printer->text("TIPO: " . $sale->type . "\n");
        $printer->text("CLIENTE: " . $sale->customer->user->name . "\n");

        // array de productos / detalle de la venta
        $items = array();
        foreach ($sale->details as $detail) {
            array_push($items, new item(strtoupper($detail->product->name) . ' x' . $detail->quantity, $detail->price)); // ITEM( PLAYERA X 2, PRICE, FORMAT)
        }

        //
        $itemsQty = new item("Articulos", $sale->items);
        $total = new item("Total", $sale->total, true);
        $pendingPay = new item("Adeudo", $sale->pending_pay, true);

        $printer->text("===============================================\n");
        $printer->setEmphasis(true);
        $concepts = new item('DESCRIPCION', 'IMPORTE', false);
        $printer->text($concepts->getAsString());
        $printer->setEmphasis(false);
        $printer->text("===============================================\n");
        foreach ($items as $item) {
            $printer->text($item->getAsString());
        }
        $printer->text("-----------------------------------------------\n");
        $printer->text("\n");

        //items
        $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $printer->text($itemsQty->getAsString());
        //total
        $printer->text($total->getAsString());
        // adeudo
        $printer->text($pendingPay->getAsString());

        $printer->feed(2);
        $printer->selectPrintMode();

        // barcode
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $folio = str_pad($sale->id, 7, "0", STR_PAD_LEFT);
        $printer->setBarcodeHeight(60);
        $printer->setBarcodeTextPosition(Printer::BARCODE_TEXT_BELOW);
        $printer->barcode($folio, Printer::BARCODE_CODE39);
        $printer->feed(2);

        // footer
        $printer->text("Gracias por su compra\n");
        $printer->setEmphasis(true);
        $printer->text("luisfax.com\n");
        $printer->setEmphasis(false);
        $printer->feed(2);


        $printer->cut();
        $printer->close();
    }
}

class item
{
    // propiedades
    private $name;
    private $price;
    private $dollarSign; // $

    // constructor
    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this->name = $name;
        $this->price = $price;
        $this->dollarSign = $dollarSign;
    }

    public function getAsString()
    {
        //CANT DESCRIPCION PRICE IMPORTE

        $rigthCols = 10; // espacios importe
        $leftCols = 36; // espacios descripcion

        if ($this->dollarSign) {
            $leftCols = ($leftCols / 2) - ($rigthCols / 2);
        }

        //PLAYERA x2      200.00
        $left = str_pad($this->name, $leftCols); // "PLAYERA      "

        $sign = ($this->dollarSign ? '$' : '');

        $right = str_pad($sign . $this->price, $rigthCols, ' ', STR_PAD_LEFT);
        // "   $200.00"

        return "$left$right\n";
    }

    public function __toString()
    {
        return $this->getAsString();
    }
}
