






<li class="{{ Request::is('perizinans*') ? 'active' : '' }}">
    <a href="{{ route('perizinans.index') }}"><i class="fa fa-edit"></i><span>Perizinans</span></a>
</li><li class="{{ Request::is('kesehatans*') ? 'active' : '' }}">
    <a href="{{ route('kesehatans.index') }}"><i class="fa fa-edit"></i><span>Kesehatans</span></a>
</li>

<li class="{{ Request::is('prestasis*') ? 'active' : '' }}">
    <a href="{{ route('prestasis.index') }}"><i class="fa fa-edit"></i><span>Prestasis</span></a>
</li>

<li class="{{ Request::is('pembayarans*') ? 'active' : '' }}">
    <a href="{{ route('pembayarans.index') }}"><i class="fa fa-edit"></i><span>Pembayarans</span></a>
</li>

<li class="{{ Request::is('jenisBayars*') ? 'active' : '' }}">
    <a href="{{ route('jenisBayars.index') }}"><i class="fa fa-edit"></i><span>Jenis Bayars</span></a>

<li class="{{ Request::is('jenisProdukBayars*') ? 'active' : '' }}">
    <a href="{{ route('jenisProdukBayars.index') }}"><i class="fa fa-edit"></i><span>Jenis Produk Bayars</span></a>

</li>

<li class="{{ Request::is('jenisPrestasis*') ? 'active' : '' }}">
    <a href="{{ route('jenisPrestasis.index') }}"><i class="fa fa-edit"></i><span>Jenis Prestasis</span></a>
</li>




<li class="{{ Request::is('pelanggarans*') ? 'active' : '' }}">
    <a href="{{ route('pelanggarans.index') }}"><i class="fa fa-edit"></i><span>Pelanggarans</span></a>
</li>

<li class="{{ Request::is('tindakans*') ? 'active' : '' }}">
    <a href="{{ route('tindakans.index') }}"><i class="fa fa-edit"></i><span>Tindakans</span></a>
</li>




<li class="{{ Request::is('pelanggaranDetails*') ? 'active' : '' }}">
    <a href="{{ route('pelanggaranDetails.index') }}"><i class="fa fa-edit"></i><span>Pelanggaran Details</span></a>
</li>

