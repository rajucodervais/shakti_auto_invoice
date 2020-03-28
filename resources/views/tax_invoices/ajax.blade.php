@foreach($invoices as $invoice)
    <tr>
        <?php
        $id = $invoice->id;
        $string1 = 'SAM/';
        $string2 = str_pad($id, 6, "0", STR_PAD_LEFT);
        $date = date('Y',strtotime($invoice->created_at));
        $invoice_no = $string1.$string2.'/'.$date;
        ?>
        <td><a href="{{route('invoice.show', $invoice->id)}}" class="">{{$invoice_no}}</a></td>
        <td>{{$invoice->name}}</td>
        <td>{{$invoice->date}}</td>
        <td>{{$invoice->podate}}</td>
        <td>{{$invoice->grand_total}}</td>
        <td>{{$invoice->created_at->diffForHumans()}}</td>
        <td class="">
            <a href="{{route('createpdf', $invoice->id)}}" class="text-primary btn-sm">PDF<i class="fa fa-edit"></i></a>
            <a href="{{route('invoice.edit', $invoice->id)}}" class="text-primary btn-sm">Edit<i class="fa fa-edit"></i></a>
            <!-- <a class="text-danger" href="{{route('invoice.destroy', $invoice->id)}}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                Delete
            </a> -->

            <form id="logout-form" action="{{route('invoice.destroy', $invoice->id)}}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </td>
    </tr>
@endforeach