<h1>You have a new <b>3W</b></h1>

@isset($tW)
    
    <table style="border: 1px solid black; width:100%;">
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;"> 3W </td>
            <td style="border: 1px solid black;"> {{ $tW->title }} </td>
        </tr>
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;"> Start Date </td>
            <td style="border: 1px solid black;"> {{ $tW->start_date }} </td>
        </tr>
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;"> Due Date </td>
            <td style="border: 1px solid black;"> {{ $tW->due_date }} </td>
        </tr>
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;"> Description </td>
            <td style="border: 1px solid black;"> {{ $tW->description }} </td>
        </tr>
        <tr style="border: 1px solid black;">
            <td style="border: 1px solid black;"> Raised By </td>
            <td style="border: 1px solid black;"> {{ $tW->created_user }} </td>
        </tr>
    </table>

    Click the following link to view <a href="{!! route('tw.show', $tW->id) !!}"> Link </a>
@endisset

<p>****** System Genarated Message ******</p>