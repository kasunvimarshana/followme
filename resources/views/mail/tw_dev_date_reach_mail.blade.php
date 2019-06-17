<!-- h1>You have a dev date reach <b>3W</b></h1 -->

@isset($tW)

    @isset($tWUser)
        <h3>Dear {{ $tWUser->cn }},</h3>
    @endisset
    
    <p>You have a Dev Date reach 3W, Please pay your attention</p>
    <!-- style="border: 1px solid black;" -->
    <table style="width: 100%;">
        <tr style="">
            <td style="width: 15%;text-align: right !important;"> Assigned 3W : </td>
            <td style=""> {{ $tW->title }} </td>
        </tr>
        <tr style="">
            <td style="width: 15%;text-align: right !important;"> Start Date : </td>
            <td style=""> {{ $tW->start_date }} </td>
        </tr>
        <tr style="">
            <td style="width: 15%;text-align: right !important;"> Due Date : </td>
            <td style=""> {{ $tW->due_date }} </td>
        </tr>
        <tr style="">
            <td style="width: 15%;text-align: right !important;"> Description : </td>
            <td style=""> {{ $tW->description }} </td>
        </tr>
        <tr style="">
            <td style="width: 15%;text-align: right !important;"> 3W Raised By : </td>
            <td style=""> {{ $tW->created_user }} </td>
        </tr>
    </table>

    Click the following link to view <a href="{!! route('tw.show', $tW->id) !!}"> Link </a>
@endisset

<p>****** System Genarated Message ******</p>