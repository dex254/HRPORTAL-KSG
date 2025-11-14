<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Innovation Report - {{ $innovation->innovation_number }}</title>
    <style>
        @page {
            margin: 50px 40px;
        }

        body {
            font-family: 'Helvetica', Arial, sans-serif;
            color: #333;
            line-height: 1.5;
            background-color: #fff;
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 4px solid #6a1b9a; /* Purple accent */
        }

        .header h1 {
            font-size: 26px;
            color: #1de9b6; /* Neon Green */
            margin: 0;
        }

        .header h3 {
            font-size: 16px;
            color: #6a1b9a; /* Purple */
            margin-top: 5px;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 60px;
            color: rgba(200,200,200,0.2);
            z-index: -1;
            pointer-events: none;
            white-space: nowrap;
        }

        .section {
            margin-top: 30px;
            padding: 15px;
            border-left: 8px solid #ff6f00; /* Orange/Brown accent */
            background: #f9f9f9;
            border-radius: 6px;
        }

        .section h2 {
            margin-top: 0;
            color: #ff6f00; /* Accent color */
        }

        .section p {
            margin: 5px 0;
        }

        .files a {
            display: inline-block;
            margin: 5px 0;
            padding: 6px 10px;
            color: #fff;
            background: #1de9b6; /* Neon Green */
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .files a:hover {
            background: #00bfa5;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #999;
        }

        .highlight {
            color: #ff6f00;
            font-weight: bold;
        }

        ol li {
            margin-bottom: 5px;
        }

    </style>
</head>
<body>

    <!-- Security Watermark -->
    <div class="watermark">
        {{ $innovation->securitykey }}
    </div>

    <div class="header">
        <h1>Innovation Report</h1>
        <h3>Innovation Number: {{ $innovation->innovation_number }}</h3>
    </div>

    <!-- User Details -->
    <div class="section">
       
        <p><strong>Security Key:</strong> <span class="highlight">{{ $innovation->securitykey }}</span></p>
    </div>

    <!-- Innovation Details -->
    <div class="section">
        <h2>Innovation Details</h2>
        <p><strong>Title:</strong> {{ $innovation->title }}</p>
        <p><strong>Content:</strong> {!! $innovation->content !!}</p>
        <p><strong>Type:</strong> {{ $innovation->innovation_type ?? 'N/A' }}</p>
        <p><strong>Link:</strong> 
            @if($innovation->link)
                <a href="{{ $innovation->link }}">{{ $innovation->link }}</a>
            @else
                N/A
            @endif
        </p>

        <div class="files">
            <p><strong>Attachment:</strong></p>
            @if($innovation->attachment)
                <a href="{{ public_path($innovation->attachment) }}" target="_blank">View / Download</a>
            @else
                N/A
            @endif

            <p><strong>Evidence:</strong></p>
            @if($innovation->evidence)
                <a href="{{ public_path($innovation->evidence) }}" target="_blank">View / Download</a>
            @else
                N/A
            @endif
        </div>
    </div>

    <div class="footer">
        Generated on {{ now()->format('d M Y, H:i') }} | <span class="highlight">Confidential & Secured</span>
    </div>

</body>
</html>
