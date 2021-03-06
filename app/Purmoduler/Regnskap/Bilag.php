<?php namespace Pur\Purmoduler\Regnskap;

use Illuminate\Database\Eloquent\Model;

class Bilag extends Model
{

    protected $table = 'bilag';

    protected $fillable = ['belop', 'nr_i_besvarelse', 'bilagssekvens_id', 'bilagsmal_id'];

    public $timestamps = false;


    /**
     * Bilagssekvensen som bilaget inngår i
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bilagssekvens()
    {
        return $this->belongsTo('Pur\Purmoduler\Regnskap\Bilagssekvens');
    }

    /**
     * Bilagsmalen som bilaget er basert på
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bilagsmal()
    {
        return $this->belongsTo('Pur\Purmoduler\Regnskap\Bilagsmal');
    }

    /**
     * Bilagets (brutto–)beløp formattert som kronebeløp
     *
     * @return float
     */
    public function belop()
    {
        return 'kr ' . number_format($this->belop, 2, ',', ' ');
    }

    /**
     * Returnerer posteringer som eleven har utført på bilaget
     *
     * @return mixed
     */
    public function elevposteringer()
    {
        return $this->posteringer()->avElev();
    }

    /**
     * Returnerer posteringer som systemet har generert som fasit for bilaget
     *
     * @return mixed
     */
    public function fasitposteringer()
    {
        return $this->posteringer()->fasit();
    }

    /**
     * Alle bilagets posteringer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posteringer()
    {
        return $this->hasMany('Pur\Purmoduler\Regnskap\Postering');
    }

    /**
     * Er sant hvis eleven har startet å arbeide med bilaget,
     * dvs. har utført posteringer for bilaget
     *
     * @return bool
     */
    public function erPaabegynt()
    {
        // TODO: Sjekk heller om bilaget har minst én korrekt postering
        return $this->elevposteringer()->count() > 1;
    }

    /**
     * Prosentandelen av bilaget som er korrekt postert av studenten
     *
     * @return float|int
     */
    public function prosentKorrekt()
    {
        $antallFasitPosteringer = $this->fasitposteringer()->count();

        $antallKorrektePosteringer = 0;
        foreach ($this->elevposteringer as $elevpostering)
            if ($elevpostering->erKorrekt())
                $antallKorrektePosteringer++;

        $prosentKorrekt = $antallKorrektePosteringer / $antallFasitPosteringer * 100;

        return ($antallFasitPosteringer == 0) ? 0 : round($prosentKorrekt, 0);
    }

}
