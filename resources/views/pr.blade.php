<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        img {
            width: 36px;
            height: 36px;
            margin-right: 0.5rem;
            border-radius: 50%;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <title>Document</title>
</head>

<body class="p-3">
    <table class="container-fluid">
        <thead>
            <tr class="row text-center">
                <th class="col">
                    <img src="{{ public_path('storage/images/test.jpeg') }}" alt="">
                    {{-- Logo --}}
                    <h3>No. 1350</h3>
                </th>
                <th class="col">
                    <h1>Hema Coffee Millers</h1>
                    <h3>GROWER'S DELIVERY NOTE</h3>
                </th>
                <th class="col">
                    <h6>P.O BOX 2-40200</h6>
                    <h6>Hema Commercial Plaza, Stadium Rd, Kisii</h6>
                    <h6>Tel: 020 - 2022548 &ThickSpace; Fax. 058 - 30660</h6>
                    <h6>Email: info@hemacoffee.com</h6>
                    <h6>URL: www.hemacoffee.com</h6>
                </th>
            </tr>
            <thead>
    </table>

    <table class="container-fluid my-3">
        <thead>
            <tr class="row">
                <th class="col">
                    <h6>Grower's Code
                        &ThickSpace;_________________________</h6>
                </th>
                <th class="col">
                    <h6>Grower's Name
                        &ThickSpace;_________________________</h6>
                </th>
            </tr>
        </thead>
    </table>
    <h6>The unlimited coffee shown on this delivery note is
        dispatched to HEMA Millers. Below are the coffee types
        associated with this note.</h6>

    <table class="container-fluid my-3">
        <thead>
            @foreach($purchases as $purchase)
            <tr class="row">
                <th class="col">
    {{purchase.coffee_bean.name}}
                </th>
                <th class="col">
                    PI
                </th>
                <th class="col">
                    PII
                </th>
                <th class="col">
                    PIII
                </th>
                <th class="col">
                    PL
                </th>
                <th class="col">
                    MBUNI
                </th>
            </tr>
        </thead>
    </table>

    <table class="container-fluid my-3">
        <thead>
            <tr class="row">
                <th class="col">
                    <h6>How many bags will be in this outturn
                        &ThickSpace;_________________________</h6>
                </th>
                <th class="col">
                    <h6>Road delivery vehicle No.
                        &ThickSpace;_________________________</h6>
                </th>
            </tr>
            <tr class="row mt-1">
                <th class="col">
                    <h6>How many bags will be in delivery
                        &ThickSpace;_________________________</h6>
                </th>

            </tr>
        </thead>
    </table>


    <table>
        <td colspan="2">

            <table class="container-fluid my-3 col">
                <thead>
                    <tr class="row">
                        <th class="col">
                            <h5>
                                Comments:-
                            </h5>
                        </th>

                    <tr>
                        <th class="col">
                            <h6>Yellow copy - Hema Accounts
                            </h6>
                        </th>
                    </tr>
                    <tr>
                        <th class="col">
                            <h6>Green Copy - Grower </h6>
                        </th>
                    </tr>


                    </tr>

                </thead>
            </table>
            <table class="container-fluid table-bordered">
                <thead>
                    <tr>
                        <th class="px-3">Store </th>
                        <th class="px-3">Floor</th>
                        <th class="px-3">Row</th>
                        <th class="px-3">Bay</th>
                        <th class="px-3">Bags in</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-3">Germany</td>
                        <td class="px-3">Germany</td>
                        <td class="px-3">12</td>
                        <td class="px-3">Germany</td>
                        <td class="px-3">90</td>
                    </tr>

                </tbody>
            </table>
            <table>
                <tr class="row mt-1">
                    <th class="col">
                        <h6 class="pt-2">Outturn
                            &ThickSpace;_________________________</h6>
                    </th>
                </tr>
            </table>
        </td>

        <td>
            <table class="table table-responsive-sm ps-5 pt-3">
                <thead>
                    <th class="col">
                        <h5>
                            Empty bags instruments:-
                        </h5>
                    </th>
                    <tr class="row">
                        <th class="col">
                            <h6>To be sent to
                                &ThickSpace;_________________________</h6>
                        </th>
                    <tr>
                        <th class="col">
                            <h6>To be collected from
                                &ThickSpace;_________________________</h6>
                        </th>

                    </tr>
                    <tr>
                        <th class="col">
                            <h5>Factory Manager</h5>
                        </th>
                    <tr>
                        <th class="col">
                            <h6>Sign
                                &ThickSpace;_________________________</h6>
                        </th>

                    </tr>

                    <tr>
                        <th class="col">
                            <h6>Date
                                &ThickSpace;_________________________</h6>
                        </th>
                    </tr>

                    </tr>


                    </tr>

                </thead>
            </table>
        </td>

    </table>


</body>

</html>
