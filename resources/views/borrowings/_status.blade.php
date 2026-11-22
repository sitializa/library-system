@if($borrowing->status === 'returned')
    <span class="badge badge-returned">Dikembalikan</span>
@elseif($borrowing->isOverdue())
    <span class="badge badge-late">Terlambat</span>
@else
    <span class="badge badge-borrowed">Dipinjam</span>
@endif