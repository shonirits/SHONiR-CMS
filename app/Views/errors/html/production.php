<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= lang('Errors.whoops') ?> - Unexpected Error</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #fdfbfb, #ebedee);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 10vh auto;
            padding: 2rem;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1.headline {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            color: #dd4814;
        }
        p.lead {
            font-size: 1.2rem;
            color: #555;
        }
        .btn {
            display: inline-block;
            margin-top: 2rem;
            padding: 0.75rem 1.5rem;
            background-color: #dd4814;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background-color: #c43d0f;
        }
        .footer {
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #999;
        }
    </style>
</head>
<body>

    <div class="container text-center">
        <h1 class="headline"><?= lang('Errors.whoops') ?></h1>
        <p class="lead"><?= lang('Errors.weHitASnag') ?></p>
        <p><b>Something went wrong on our end. The website is still working, and we're looking into it.</b></p>
        <a href="<?= base_url(); ?>" class="btn">Return to Homepage</a>
        <div class="footer">If the problem persists, feel free to contact support.</div>
    </div>

</body>
</html>
