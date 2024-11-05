<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Transaction; //jgn lupa import transactionnya kalo ga nanti error

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // incomes dan expenses dari model transaction
        $pemasukan = Transaction::incomes()->get()->sum('amount');
        $pengeluaran = Transaction::expenses()->get()->sum('amount');

        // Format angka dengan titik sebagai pemisah ribuan dan tambahkan mata uang
        $formattedPemasukan = 'Rp. ' . number_format($pemasukan, 0, ',', '.');
        $formattedPengeluaran = 'Rp. ' . number_format($pengeluaran, 0, ',', '.');
        $formattedSelisih = 'Rp. ' . number_format($pemasukan - $pengeluaran, 0, ',', '.');

        return [
            Stat::make('Total Pemasukan', $formattedPemasukan),
            Stat::make('Total Pengeluaran', $formattedPengeluaran),
            Stat::make('Selisih', $formattedSelisih),
        ];
    }
}