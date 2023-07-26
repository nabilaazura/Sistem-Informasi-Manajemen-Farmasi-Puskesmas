<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{

    public function construct()
    {
        parent::construct();
    }

    public function generate_pdf($html, $filename, $output = true)
    {
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor('Your Author');
        $this->SetTitle('Your Title');
        $this->SetSubject('Your Subject');
        $this->SetKeywords('Keywords');

        $this->setPrintHeader(false);
        $this->setPrintFooter(false);

        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $this->SetMargins(10, 10, 10);
        $this->SetAutoPageBreak(TRUE, 10);

        $this->SetFont('helvetica', '', 11);

        $this->AddPage();
        $this->writeHTML($html, true, false, true, false, '');

        if ($output) {
            $this->Output($filename, 'I');
        } else {
            return $this->Output($filename, 'S');
        }
    }
}
