<?php

class Util
{

    public static function calcularRendimento($aporteIni, $periodo, $rendimentoMen, $aporteMen)
    {
        $total = $aporteIni;
        $dados = array();
        for ($i = 1; $i <= $periodo; $i++) {
            $aporte = ($i == 1) ? 0 : $aporteMen;
            $rendimento = ($total + $aporte) * ($rendimentoMen / 100);
            $total += $aporte + $rendimento;
            $dados[] = array('mes' => $i, 'inicial' => $aporteIni, 'aporte' => $aporte, 'rendimento' => $rendimento, 'total' => $total);
        }
        return array('dados' => $dados, 'total' => $total);
    }
}
    