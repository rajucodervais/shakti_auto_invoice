@foreach($quotations as $quotation)
    <tr>
        <?php
        $id = $quotation->id;
        $string1 = 'SAM/';
        $string2 = str_pad($id, 6, "0", STR_PAD_LEFT);
        $date = date('Y',strtotime($quotation->created_at));
        $quotation_no = $string1.$string2.'/'.$date;
        ?>
        <td><a href="{{route('quotation.show', $quotation->id)}}" class="">{{$quotation_no}}</a></td>
        <td>{{$quotation->name}}</td>
        <td>{{$quotation->date}}</td>
        <td>{{$quotation->grand_total}}</td>
        <td>{{$quotation->created_at->diffForHumans()}}</td>
        <td class="">
            <a href="{{route('createquotationpdf', $quotation->id)}}" class="text-primary btn-sm">PDF<i class="fa fa-edit"></i></a>
            <a href="{{route('quotation.edit', $quotation->id)}}" class="text-primary btn-sm">Edit<i class="fa fa-edit"></i></a>
            <!-- <a class="text-danger" href="{{route('quotation.destroy', $quotation->id)}}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                Delete
            </a> -->

            <form id="logout-form" action="{{route('quotation.destroy', $quotation->id)}}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </td>
    </tr>
@endforeach