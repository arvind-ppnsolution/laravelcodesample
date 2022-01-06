@forelse($items as $item)
<tr>
    <th scope="row">{{(($items->currentPage() * $items->perPage()) + $loop->iteration) - $items->perPage()}}</th>
    <td>{{$item->full_name}}</td>
    <td>{{$item->email}} ({{$item->country_code}} {{$item->mobile}})</td>
    <td><a data-placement="bottom" title="Click to change status"
            class="btn btn-{{$item->status == '1' ? 'primary' : 'info'}} btn-sm waves-effect"
            onclick="changeStatus({{$item->id}}, $(this))"
            href="javascript:void(0)">{{$item->status == '1' ? 'Active' : 'Inactive'}}</a></td>
    <td>
        <a class="btn btn-primary btn-sm waves-effect" href="{{ route('mechanic.edit',$item->id)}}"><i
                class="flaticon-eye"></i></a>
        <a class="btn btn-danger btn-sm waves-effect" onclick="deleteRecord('{{$item->id}}', $(this))" href="javascript:void(0)"><i
                class="flaticon-delete"></i></a>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" align="center"> No Mechanic Found!</td>
</tr>
@endforelse