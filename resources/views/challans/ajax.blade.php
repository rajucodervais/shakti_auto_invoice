@foreach($challan as $challan)
    <tr>
        <?php
        $id = $challan->id;
        $string1 = 'CH/';
        $string2 = str_pad($id, 6, "0", STR_PAD_LEFT);
        $date = date('Y',strtotime($challan->created_at));
        $challan_no = $string1.$string2.'/'.$date;
        ?>
        <td><a href="{{route('challan.show', $challan->id)}}" class="">{{$challan_no}}</a></td>
        <td>{{$challan->name}}</td>
        <td>{{$challan->date}}</td>
        <td>{{$challan->podate}}</td>
        <td>{{$challan->created_at->diffForHumans()}}</td>
        <td class="">
            <a href="{{route('createchallanpdf', $challan->id)}}" class="text-primary btn-sm">PDF<i class="fa fa-edit"></i></a>
            <a href="{{route('challan.edit', $challan->id)}}" class="text-primary btn-sm">Edit<i class="fa fa-edit"></i></a>
            <!-- <a class="text-danger" href="{{route('challan.destroy', $challan->id)}}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                Delete
            </a> -->

            <form id="logout-form" action="{{route('challan.destroy', $challan->id)}}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </td>
    </tr>
@endforeach
