<?php

namespace App\Repositories;

use Bpjs\Bridging\Vclaim\BridgeVclaim;

class RencanaKontrolRepository
{
    protected $bridging;

    public function __construct()
    {
        $this->bridging = new BridgeVclaim();
    }

    /**
     * Get Surat Kontrol.
     * @param string|int $bulan
     * @param string|int $tahun
     * @param string|int $nomorKartu
     * @return mixed The retrieved Surat Kontrol data, or null if not found.
     */

    public function getByNomorKartu($bulan, $tahun, $nomorKartu)
    {
        $endpoint = 'RencanaKontrol/ListRencanaKontrol/Bulan/' . $bulan . '/Tahun/' . $tahun . '/NoKartu/' . $nomorKartu . '/filter/2';
        $result = $this->bridging->getRequest($endpoint);
        return json_decode($result, true);
    }

    public function findSep($noSep)
    {
        $endpoint = 'RencanaKontrol/nosep/' . $noSep;
        $result = $this->bridging->getRequest($endpoint);
        return json_decode($result, true);
    }

    public function findByNomorSurat($noSurat)
    {
        $endpoint = 'RencanaKontrol/noSuratKontrol/' . $noSurat;
        $result = $this->bridging->getRequest($endpoint);
        return json_decode($result, true);
    }

    public function insert($data)
    {
        $endpoint = 'RencanaKontrol/insert';
        $data = $this->bridging->postRequest($endpoint, $data);
        return json_decode($data, true);
    }

    public function delete($data)
    {
        $endpoint = 'RencanaKontrol/Delete';
        $data = $this->bridging->deleteRequest($endpoint, $data);
        return json_decode($data, true);
    }

    public function pesertaByNomor($noKartu)
    {
  
        $date = date('Y-m-d');
        $endpoint = 'Peserta/nokartu/'.$noKartu.'/tglSEP/' . $date ;
        $data = $this->bridging->getRequest($endpoint);
        return json_decode($data, true);
    }
}
