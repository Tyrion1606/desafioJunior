<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

trait Utils
{
     /**
     * @param string $variable
     * @return array|string|string[]|null
     */
    public function clear_tags(string $variable)
    {
        return preg_replace('(<(/?[^\>]+)>)', '', $variable);
    }

    /**
     * @param $date
     * @param $format
     * @return string
     */
    public function formatDate($date, $format)
    {
        return Carbon::createFromFormat('d/m/Y', $date)->format($format);
    }

    /**
     * Função para limpar Mascara
     *
     * @param string $variable
     * @return string|string[]|null
     */
    public function clear_mask(string $variable)
    {
        return preg_replace('/\D+/', '', $variable);
    }
}
