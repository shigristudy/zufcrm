<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>

<body>
   
    @foreach ($sponsorships as $sponsorship)
    <div>
        <table style="width: 100%;">
            <tr>
                <td style="text-align: center;">
                    <h1 style="color: green;margin: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Zia Ul Ummah Foundation</h1>
                    <h3 style="color: #6bb56b;margin: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ ucfirst($sponsorship->student->student_type) }} Student</h3>
                    <br>
                </td>
                <td style="text-align: right;">
                    <img style="background-color: green; padding: 10px;border-radius: 5px;"
                    src="https://www.ziaulummahfoundation.org.uk/wp-content/uploads/2020/03/zuf-logo-whitept.png"></td>
            </tr>
            <tr>
                <td style="width: 80%;text-align:justify">
                    <h4 class="font-weight-bold">Dear {{ ucfirst($sponsorship->order->first_name) . ' ' . ucfirst($sponsorship->order->last_name) }}</h4>
                    <br>
                    @if($sponsorship->student->student_type == 'scholar')
                        {!! \App\Models\Option::get('report_para_scholar') !!}
                    @else
                        {!! \App\Models\Option::get('report_para_hifz') !!}
                    @endif
                </td>
                <td style="width: 30%;">
                    &nbsp;&nbsp;&nbsp;&nbsp;<img style="width: 150px;" src="{{ $url }}">
                    <br>
                    <h4 style="color: green;">&nbsp;&nbsp;&nbsp;&nbsp;Student Details:</h4><br>
                    <h5 style="margin-bottom: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;Name:</h5>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $sponsorship->student->fullname }}</p>
                    <br>
                    <h5>&nbsp;&nbsp;&nbsp;&nbsp;Father Name:</h5>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $sponsorship->student->father_name }}</p>
                    <br>
                    <h5>&nbsp;&nbsp;&nbsp;&nbsp;Gender:</h5>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $sponsorship->student->gender }}</p>
                    <br>
                    <h5>&nbsp;&nbsp;&nbsp;&nbsp;From City:</h5>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $sponsorship->student->city }}</p>
                    <br>
                    <h5>&nbsp;&nbsp;&nbsp;&nbsp;From State/Province:</h5>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $sponsorship->student->province }}</p>
                    <br>
                    <h5>&nbsp;&nbsp;&nbsp;&nbsp;Para Number:</h5>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $sponsorship->student->para_number }}</p>
                    <br>
                    <h5>&nbsp;&nbsp;&nbsp;&nbsp;Teacher Name:</h5>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $sponsorship->student->teacher_name }}</p>
                    <br>
                    <h5>&nbsp;&nbsp;&nbsp;&nbsp;DMG Ref:</h5>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $sponsorship->student->dmg_ref }}</p>
                    <br>
                    <h5>&nbsp;&nbsp;&nbsp;&nbsp;ZUF Ref:</h5>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ $sponsorship->student->zuf_ref }}</p>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;" colspan="2">
                    <br>
                    <br>
                    <p class="m-0">zia ul ummah foundation, UK registered charity number: 1131760</p>
                    <p class="mb-5">13 Victoria st, Bordesley Green,Birmingham, B9 5AA. UK phone: 0121 270 4786</p>
                </td>
            </tr>
        </table>
    </div>
    @endforeach
</body>

</html>