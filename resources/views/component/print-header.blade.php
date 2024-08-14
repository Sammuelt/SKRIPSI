<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Download Data</title>
        
        <style>
            body {
                font-family: "Times New Roman", Times, serif;
                margin: 0;
                padding: 0;
                width: 210mm;
                height: 297mm;
            }
            .container {
                width: 190mm;
                margin: auto;
                padding: 20mm;
                box-sizing: border-box;
            }
            .header {
                display: flex;
                align-items: center;
                margin-bottom: 1rem;
                border-bottom: 1px solid black;
                padding-bottom: 10px;
            }
            .header img {
                height: 50px;
                width: auto;
    
            }
            .header div {
                flex-grow: 1;
                text-align: center;
             
                padding-right: 50px;
            }
            .header h1 {
                font-size: 1.5rem;
                margin: 0;
            }
            .header p {
                font-size: 0.9rem;
                margin: 0;
            }
            .page-break {
                page-break-before: always;
            }
            h2 {
                font-size: 1.25rem;
                text-align: center;
                margin: 1rem 0;
                font-weight: bold;
            }
            p,
            td {
                font-size: 1rem;
                margin-bottom: 0.5rem;
            }
            .underline {
                border-bottom: 1px solid black;
                display: inline-block;
                width: 100%;
            }
            table {
                width: 100%;
                margin-bottom: 1rem;
                border-collapse: collapse;
                border: 1px solid black;
            }
            table th,
            table td {
                padding: 5px;
                border: 1px solid black;
            }
            .signature-table td {
                padding-top: 20px;
                vertical-align: top;
            }
            .sign-space {
                padding-top: 40px;
            }
            .text-right {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <img
                    src="https://awsimages.detik.net.id/community/media/visual/2023/05/02/lambang-tut-wuri-handayani.png?w=1200"
                    alt="SMAN4BANJARBARU"
                />
                <div>
                    <h1>SD Negeri 3 Sungai Tiung</h1>
                    <p>
                        Jln. Transpol Cempaka Rt/rw 033
                    </p>
                </div>
            </div>

            @yield('content')

            {{-- <div class="page-break"></div> --}}

        </div>
    </body>
</html>
