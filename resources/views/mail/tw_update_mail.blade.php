<!-- h1><b>Title</b></h1 -->

@isset($tW)
    
    @isset($tWUser)
        <p>Dear {{ $tWUser->cn }},</p>
    @endisset

    <h3>3W was updated, Please pay your attention</h3>
    <!-- style="border: 1px solid black;" -->
    <table style="width: 100%;">
        <tr style="">
            <td style="width: 15%;text-align: right !important;"> Assigned 3W : </td>
            <td style=""> {{ $tW->title }} </td>
        </tr>
        <tr style="">
            <td style="width: 15%;text-align: right !important;"> Description : </td>
            <td style=""> {{ $tW->description }} </td>
        </tr>
        <tr style="">
            <td style="width: 15%;text-align: right !important;"> Start Date : </td>
            <td style=""> {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tW->start_date)->format('Y-m-d') }} </td>
        </tr>
        <tr style="">
            <td style="width: 15%;text-align: right !important;"> Due Date : </td>
            <td style=""> {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $tW->due_date)->format('Y-m-d') }} </td>
        </tr>
        <tr style="">
            <td style="width: 15%;text-align: right !important;"> 3W Raised By : </td>
            <td style=""> {{ $tW->created_user }} </td>
        </tr>
    </table>

    <p>Click the following link to view <a href="{!! route('tw.show', $tW->id) !!}"> Link </a></p>
@endisset

<p>****** System Genarated Message ******</p>