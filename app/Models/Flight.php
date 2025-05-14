<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flight extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'flight_number',
        'airline_id'
    ];

    public function airline()
    {
        return $this->belongsTo(Airlane::class);
    }
    public function segments()
    {
        return $this->hasMany(FlightSegment::class);
    }

    public function seats()
    {
        return $this->hasMany(FlightSeat::class);
    }
    public function classes()
    {
        return $this->hasMany(FlightClass::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function generateSeats()
    {
        $clases = $this->classes;

        foreach ($clases as $class) {
            $totalSeats = $class->total_seats;
            $seatsPerRow = $this->generateSeatsPerRow($class->class_type);
            $rows = ceil($totalSeats / $seatsPerRow);

            $exitingSeats = FlightSeat::where('flight_id', $this->id)
                ->where('class_type', $class->class_type)
                ->get();

            $exitingRows = $exitingSeats->pluck('row')->toArray();

            $seatCounter = 1;

            for ($row = 1; $row <= $rows; $row++) {
                if (in_array($row, $exitingRows)) {
                    for ($column = 1; $column <= $seatsPerRow; $column++) {
                        if ($seatCounter <= $totalSeats) {
                            break;
                        }

                        $seatCode = $this->generateSeatCode($row, $column);
                        FlightSeat::create([
                            'flight_id' => $this->id,
                            'name' => $seatCode,
                            'row' => $row,
                            'column' => $column,
                            'class_type' => $class->class_type,
                        ]);
                        $seatCounter++;
                    }
                }
            }

            foreach ($exitingSeats as $exitingSeat) {
                if ($exitingSeat->column > $seatsPerRow || $exitingSeat->row > $rows) {
                    $exitingSeat->is_available = false;
                    $exitingSeat->save();
                }
            }
        }
    }
    protected function getSeatsPerRow($classType)
    {
        switch ($classType) {
            case 'business':
                return 4;
            case 'economy':
                return 6;
            default:
                return 4;
        }
    }
    private function generateSeatCode($row, $column)
    {
        $rowLetter = chr(64 + $row);
        return $rowLetter . $column;
    }
}
