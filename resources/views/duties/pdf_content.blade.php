<!DOCTYPE html>
<html>

<head>
    <title>Monthly Report: {{ $month . ' ' . $year }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            padding: 0;
        }

        .details {
            margin-bottom: 20px;
        }

        .details p {
            margin: 0;
            padding: 5px 0;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .order-table th,
        .order-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .order-table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .total-price {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Monthly Reports for : {{ $month . ' / ' . $year }}</h2>
    </div>

    User details
    <div class="details">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone No:</strong> {{ $user->phone_no }}</p>
        <p><strong>Position:</strong> {{ $user->position }}</p>
    </div>

    <h3 class="my-3 text-center w-full">Duty Records<h3>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Date</th>
                        <th>Duty</th>
                        <th>Clock in</th>
                        <th>Clock out</th>
                        <th>Remarks</th>
                        <th>Working hours</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalDuration = 0;
                    @endphp
                    @foreach ($duties as $index => $duty)
                        <tr>
                            <td>{{ $index + 1 }}.</td>
                            <td>{{ $duty->date }}</td>
                            <td>{{ $duty->duty_type->name }}</td>
                            <td>{{ $duty->start }}</td>
                            <td>{{ $duty->end }}</td>
                            <td>{{ $duty->remarks }}</td>
                            <td>{{ $duty->formatted_duration }}</td>
                        </tr>

                        @php
                            $totalDuration += $duty->duration;
                        @endphp
                    @endforeach

                </tbody>
            </table>

            <div class="total-price">
                <strong>Total Hours Worked:</strong> {{ sprintf('%02d hours, %02d minutes', $totalHours, $totalMinutes) }}
            </div>


            <h3 class="my-3 text-center w-full">Leave Records<h3>
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Leave Type</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalLeave = 0;
                            @endphp
                            @foreach ($leaves as $index => $leave)
                                <tr>
                                    <td>{{ $index + 1 }}.</td>
                                    <td>{{ $leave->leave_type->name }}</td>
                                    <td>{{ $leave->start }}</td>
                                    <td>{{ $leave->end }}</td>
                                    <td>{{ $leave->status }}</td>
                                </tr>

                                @php
                                    $totalLeave += $duty->leaved;
                                @endphp
                            @endforeach

                        </tbody>
                    </table>
                    <div class="total-price">
                        <strong>Total Leave:</strong> {{ $totalLeaveDays }} days
                    </div>


</body>

</html>
