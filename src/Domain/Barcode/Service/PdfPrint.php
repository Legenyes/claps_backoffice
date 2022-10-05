<?php

namespace Domain\Barcode\Service;

use TCPDF;

/*
 * See documentation:
 * https://tcpdf.org/docs/srcdoc/TCPDF/class-TCPDF/
 */

/**
 * Class PdfPrint
 * @package App\Utils\Pdf
 */
class PdfPrint extends TCPDF
{
    /**
     * @return PdfPrint
     */
    static public function createA4(): PdfPrint
    {
        $pdf = new PdfPrint('P','mm','A4');

        $pdf->SetMargins(20,10,15);
        $pdf->SetAutoPageBreak(false);

        return $pdf;
    }

    /**
     * @inheritDoc
     */
    public function Footer(): void
    {
    }

    /**
     * @inheritDoc
     */
    public function Header(): void
    {
    }

    /**
     * Compute the height of the multicell
     * @param int $w
     * @param int $h
     * @param string $txt
     * @param int|string $border
     * @param string $align
     * @param int $fill
     * @return int
     */
    public function ProbeMultiCell(int $w, int $h, string $txt, $border = 0, string $align = 'J', int $fill = 0): int
    {
        $newy = $this->y;
        //Output text with automatic or explicit line breaks
        if ($w == 0) {
            $w = $this->w - $this->rMargin - $this->x;
        }
        $wmax = ($w-$this->cell_margin['L'] - $this->cell_margin['R'])*1000/$this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb>0 && $s[$nb-1]=="\n") {
            $nb--;
        }
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        while ($i<$nb) {
            //Get next character
            $c=$s[$i];
            if ($c=="\n") {
                //Explicit line break
                $newy+=$h;
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                continue;
            }
            if ($c==' ') {
                $sep=$i;
            }
            $l+=$this->getRawCharWidth($c);
            if ($l>$wmax) {
                //Automatic line break
                if ($sep==-1) {
                    if($i==$j) {
                        $i++;
                    }
                    $newy+=$h;
                } else {
                    $newy+=$h;
                    $i=$sep+1;
                }
                $sep=-1;
                $j=$i;
                $l=0;
            } else {
                $i++;
            }
        }
        //Last chunk
        $newy += $h;
        return $newy;
    }

    /**
     * This function must be called to restore the state of the php engine. Failure
     * to do so results in mb_ functions processing ascii instead of the expected utf-8.
     * @return void
     */
    public function freeResources(): void
    {
        $this->_destroy(true);
    }
}
