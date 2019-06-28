<!-- h1><b>Title</b></h1 -->

@isset($tW)
    
    @isset($tWUser)
        <p>Dear {{ $tWUser->cn }},</p>
    @endisset

    <h3>You have a new 3W information, Please pay your attention</h3>
    <!-- style="border: 1px solid black;" -->
    <table style="width: 100%;">
        <tr style="">
            <td style="width: 15%;text-align: right !important;"> 3W : </td>
            <td style=""> {{ $tW->title }} </td>
        </tr>
        <tr style="">
            <td style="width: 15%;text-align: right !important;"> Information : </td>
            <td style=""> {{ $tWInfo->description }} </td>
        </tr>
        <tr style="">
            <td style="width: 15%;text-align: right !important;"> Raised By : </td>
            <td style=""> {{ $tWInfo->created_user }} </td>
        </tr>
    </table>

    <p>Click the following link to view 3W <a href="{!! route('tw.show', $tW->id) !!}"> Link </a></p>
    <p>Click the following link to view 3W information <a href="{!! route('twInfo.show', $tWInfo->id) !!}"> Link </a></p>
@endisset

<p>****** System Genarated Message ******</p>