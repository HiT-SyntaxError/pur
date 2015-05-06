<?php namespace Pur\Purmoduler\Regnskap;

use Illuminate\Database\Eloquent\Model;

class Postering extends Model {

    protected $table = 'posteringer';

    protected $fillable = ['belop', 'ant_lagringer', 'er_fasit', 'bilag_id', 'kontokode'];

    const CREATED_AT = 'tid_opprettet';
    const UPDATED_AT = 'tid_endret';

    /**
     * Formattert tidspunkt for da posteringen ble opprettet
     *
     * @return mixed
     */
    public function tidOpprettet()
    {
        return $this->tid_opprettet->format('d.m.y H:i');
    }

    /**
     * Formattert tidspunkt for da posteringen sist ble endret
     *
     * @return mixed
     */
    public function tidEndret()
    {
        return $this->tid_endret->format('d.m.y H:i');
    }

    /**
     * Begrenser spørreresultatet til rader der kolonnen 'er_fasit' = 'false'
     *
     * @param $query
     */
    public function scopeAvElev($query)
    {
        $query->whereErFasit(false);
    }

    /**
     * Begrenser spørreresultatet til rader der kolonnen 'er_fasit' = 'true'
     *
     * @param $query
     */
    public function scopeFasit($query)
    {
        $query->whereErFasit(true);
    }

    /**
     * Bilaget som posteringen tilhører
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bilag()
    {
        return $this->belongsTo('Pur\Purmoduler\Regnskap\Bilag');
    }

    /**
     * Kontoen som brukes i posteringen
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function konto()
    {
        return $this->belongsTo('Pur\Purmoduler\Regnskap\Konto', 'kontokode', 'kontokode');
    }
}
