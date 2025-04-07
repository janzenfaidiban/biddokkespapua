@if (Request::segment('2') != 'jemaat')
<th>Keterangan</th>
@endif
@if (Auth::user()->hasRole('adminmaster'))
<th>Created at</th>
<th>Updated at</th>
<th>Aksi</th>
@endif